<template>
    <v-container class="visitor-parking-claim-page">
        <v-row justify="center">
            <v-col cols="12" md="8" lg="6">
                <!-- 頁面標題 -->
                <v-card class="mb-6" elevation="2">
                    <v-card-title class="text-h4 text-center bg-teal pa-6">
                        <v-icon size="large" class="mr-3">mdi-car-parking-lights</v-icon>
                        訪客停車證領取
                    </v-card-title>
                </v-card>

                <!-- 載入中 -->
                <v-card v-if="loading" class="text-center pa-10">
                    <v-progress-circular
                        indeterminate
                        color="teal"
                        size="64"
                    ></v-progress-circular>
                    <p class="mt-4 text-h6">正在載入申請資料...</p>
                </v-card>

                <!-- 錯誤訊息 -->
                <v-card v-else-if="error" class="pa-6">
                    <v-alert type="error" variant="tonal" prominent>
                        <v-alert-title>
                            <v-icon>mdi-alert-circle</v-icon>
                            載入失敗
                        </v-alert-title>
                        <div class="mt-2">{{ error }}</div>
                    </v-alert>
                    <div class="text-center mt-4">
                        <v-btn color="primary" @click="router.push({ name: 'Home' })">
                            返回首頁
                        </v-btn>
                    </div>
                </v-card>

                <!-- 申請資料顯示 -->
                <v-card v-else-if="application" class="pa-6">
                    <!-- 狀態顯示 -->
                    <v-alert
                        :type="getAlertType(application.status)"
                        variant="tonal"
                        prominent
                        class="mb-6"
                    >
                        <v-alert-title class="text-h6">
                            <v-icon>{{ getStatusIcon(application.status) }}</v-icon>
                            {{ application.status_text }}
                        </v-alert-title>
                        <div class="mt-2">{{ getStatusDescription(application.status) }}</div>
                    </v-alert>

                    <!-- 申請資訊 -->
                    <v-card variant="outlined" class="mb-6">
                        <v-card-title class="bg-grey-lighten-4">
                            <v-icon class="mr-2">mdi-information</v-icon>
                            申請資訊
                        </v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12" sm="6">
                                    <div class="text-subtitle-2 text-grey">申請人姓名</div>
                                    <div class="text-body-1 font-weight-bold">{{ application.name }}</div>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <div class="text-subtitle-2 text-grey">電子郵件</div>
                                    <div class="text-body-1">{{ application.email }}</div>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <div class="text-subtitle-2 text-grey">車牌號碼</div>
                                    <div class="text-body-1">{{ application.vehicle_plate_number }}</div>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <div class="text-subtitle-2 text-grey">車種</div>
                                    <div class="text-body-1">{{ application.vehicle_type }}</div>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <div class="text-subtitle-2 text-grey">車輛資訊</div>
                                    <div class="text-body-1">{{ application.brand_model }} / {{ application.color }}</div>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <div class="text-subtitle-2 text-grey">停車期間</div>
                                    <div class="text-body-1">
                                        {{ application.parking_start_date }} ~ {{ application.parking_end_date }}
                                    </div>
                                </v-col>
                                <v-col v-if="application.permit_id" cols="12" sm="6">
                                    <div class="text-subtitle-2 text-grey">停車證編號</div>
                                    <div class="text-body-1 font-weight-bold text-teal">
                                        {{ application.permit_id }}
                                    </div>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>

                    <!-- 待審核狀態 -->
                    <v-card v-if="application.status === 'pending'" variant="outlined" color="warning">
                        <v-card-text class="text-center pa-6">
                            <v-icon size="80" color="warning">mdi-clock-outline</v-icon>
                            <div class="text-h6 mt-4">您的申請正在審核中</div>
                            <div class="text-body-2 mt-2 text-grey">請耐心等待，審核結果將寄送至您的電子郵件</div>
                        </v-card-text>
                    </v-card>

                    <!-- 已核准狀態 - 顯示 QR Code -->
                    <v-card v-else-if="application.status === 'approved'" variant="outlined" color="success">
                        <v-card-text class="text-center pa-6">
                            <div v-if="!application.is_issued">
                                <v-icon size="80" color="success">mdi-check-circle</v-icon>
                                <div class="text-h6 mt-4 mb-2">您的申請已核准！</div>
                                <div class="text-body-2 text-grey mb-6">
                                    請使用 TW-DIW 數位皮夾掃描以下 QR Code 領取停車證
                                </div>

                                <!-- QR Code 顯示 -->
                                <div v-if="application.qr_code" class="qr-code-container mb-4">
                                    <img :src="application.qr_code" alt="停車證 QR Code" class="qr-code-image">
                                </div>

                                <!-- Deep Link 按鈕 -->
                                <div v-if="application.deep_link" class="mb-4">
                                    <v-btn
                                        :href="application.deep_link"
                                        color="teal"
                                        size="large"
                                        variant="elevated"
                                        prepend-icon="mdi-wallet"
                                    >
                                        開啟數位皮夾
                                    </v-btn>
                                </div>

                                <v-divider class="my-6"></v-divider>

                                <!-- 手動確認領取區域 -->
                                <div class="manual-claim-section">
                                    <div class="text-subtitle-1 mb-4">已掃描 QR Code？請輸入 VC CID 確認領取</div>
                                    <v-text-field
                                        v-model="vcCid"
                                        label="VC CID"
                                        placeholder="請輸入您從數位皮夾中取得的 VC CID"
                                        variant="outlined"
                                        :rules="[v => !!v || '請輸入 VC CID']"
                                        class="mb-4"
                                    ></v-text-field>
                                    <v-btn
                                        color="success"
                                        size="large"
                                        variant="elevated"
                                        @click="confirmClaim"
                                        :loading="claiming"
                                        :disabled="!vcCid"
                                        block
                                    >
                                        確認領取
                                    </v-btn>
                                </div>
                            </div>

                            <!-- 已領取狀態 -->
                            <div v-else>
                                <v-icon size="80" color="success">mdi-wallet-check</v-icon>
                                <div class="text-h6 mt-4">停車證已領取</div>
                                <div class="text-body-2 mt-2 text-grey">
                                    您已成功領取停車證，請在停車期間內使用
                                </div>
                            </div>
                        </v-card-text>
                    </v-card>

                    <!-- 已拒絕狀態 -->
                    <v-card v-else-if="application.status === 'rejected'" variant="outlined" color="error">
                        <v-card-text class="text-center pa-6">
                            <v-icon size="80" color="error">mdi-close-circle</v-icon>
                            <div class="text-h6 mt-4">申請已被拒絕</div>
                            <div class="text-body-2 mt-2 text-grey">如有疑問，請聯絡管理員</div>
                        </v-card-text>
                    </v-card>

                    <!-- 返回首頁按鈕 -->
                    <div class="text-center mt-6">
                        <v-btn
                            color="grey-darken-1"
                            variant="outlined"
                            @click="router.push({ name: 'Home' })"
                        >
                            返回首頁
                        </v-btn>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const router = useRouter()

const loading = ref(true)
const error = ref(null)
const application = ref(null)
const vcCid = ref('')
const claiming = ref(false)

// 載入申請資料
const loadApplication = async () => {
    loading.value = true
    error.value = null

    try {
        const visitorToken = route.params.visitorToken
        const response = await axios.get(`/api/visitor-parking/applications/${visitorToken}`)

        if (response.data.success) {
            application.value = response.data.data
        } else {
            error.value = response.data.message || '載入申請資料失敗'
        }
    } catch (err) {
        console.error('載入申請資料失敗:', err)
        error.value = err.response?.data?.message || '找不到此申請記錄'
    } finally {
        loading.value = false
    }
}

// 確認領取
const confirmClaim = async () => {
    if (!vcCid.value) {
        alert('請輸入 VC CID')
        return
    }

    claiming.value = true

    try {
        const visitorToken = route.params.visitorToken
        const response = await axios.post(
            `/api/visitor-parking/applications/${visitorToken}/claim`,
            { vc_cid: vcCid.value }
        )

        if (response.data.success) {
            alert('停車證領取成功！')
            // 重新載入申請資料
            await loadApplication()
            vcCid.value = ''
        }
    } catch (err) {
        console.error('確認領取失敗:', err)
        alert(err.response?.data?.message || '確認領取時發生錯誤')
    } finally {
        claiming.value = false
    }
}

// 取得狀態對應的 alert type
const getAlertType = (status) => {
    switch (status) {
        case 'pending':
            return 'warning'
        case 'approved':
            return 'success'
        case 'rejected':
            return 'error'
        default:
            return 'info'
    }
}

// 取得狀態圖示
const getStatusIcon = (status) => {
    switch (status) {
        case 'pending':
            return 'mdi-clock-outline'
        case 'approved':
            return 'mdi-check-circle'
        case 'rejected':
            return 'mdi-close-circle'
        default:
            return 'mdi-information'
    }
}

// 取得狀態描述
const getStatusDescription = (status) => {
    switch (status) {
        case 'pending':
            return '您的申請正在審核中，請耐心等待'
        case 'approved':
            return '您的申請已通過審核，請領取停車證'
        case 'rejected':
            return '很抱歉，您的申請未通過審核'
        default:
            return ''
    }
}

onMounted(() => {
    loadApplication()
})
</script>

<style scoped>
.visitor-parking-claim-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding-top: 40px;
    padding-bottom: 40px;
}

.qr-code-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    margin: 0 auto;
}

.qr-code-image {
    max-width: 100%;
    height: auto;
    display: block;
}

.manual-claim-section {
    background: #f5f5f5;
    padding: 24px;
    border-radius: 8px;
}
</style>
