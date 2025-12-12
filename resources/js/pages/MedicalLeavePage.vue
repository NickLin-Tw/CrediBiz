<template>
    <v-container fluid class="medical-leave-page">
        <!-- 返回 Dashboard -->
        <v-btn
            icon="mdi-arrow-left"
            variant="text"
            class="mb-4"
            @click="goBack"
        />

        <v-row justify="center">
            <v-col cols="12" md="10" lg="8">
                <!-- 頁面標題 -->
                <v-card class="mb-6" elevation="2">
                    <v-card-title class="text-h4 bg-deep-purple pa-6">
                        <v-icon size="large" class="mr-3">mdi-medical-bag</v-icon>
                        病假申請
                    </v-card-title>
                </v-card>

                <!-- 已有病假記錄（顯示最近一筆） -->
                <v-card v-if="hasRecentLeave && currentStep === 1" class="mb-6" elevation="2">
                    <v-card-title class="bg-success">
                        <v-icon class="mr-2">mdi-check-circle</v-icon>
                        您已提交病假申請
                    </v-card-title>
                    <v-card-text class="pa-6">
                        <v-row>
                            <v-col cols="12" md="6">
                                <div class="text-subtitle-2 text-grey">請假期間</div>
                                <div class="text-h6">
                                    {{ recentLeave.leave_start_date }} ~ {{ recentLeave.leave_end_date }}
                                </div>
                            </v-col>
                            <v-col cols="12" md="6">
                                <div class="text-subtitle-2 text-grey">請假天數</div>
                                <div class="text-h6">{{ recentLeave.leave_days }} 天</div>
                            </v-col>
                            <v-col cols="12" md="6">
                                <div class="text-subtitle-2 text-grey">醫療院所</div>
                                <div class="text-body-1">{{ recentLeave.hospital_name }}</div>
                            </v-col>
                            <v-col cols="12" md="6">
                                <div class="text-subtitle-2 text-grey">醫師姓名</div>
                                <div class="text-body-1">{{ recentLeave.doctor_name }}</div>
                            </v-col>
                            <v-col cols="12">
                                <div class="text-subtitle-2 text-grey">審核狀態</div>
                                <v-chip
                                    :color="getStatusColor(recentLeave.status)"
                                    size="small"
                                    class="mt-1"
                                >
                                    {{ getStatusText(recentLeave.status) }}
                                </v-chip>
                            </v-col>
                        </v-row>

                        <v-divider class="my-4"></v-divider>

                        <div class="text-center">
                            <v-btn
                                color="deep-purple"
                                variant="outlined"
                                @click="viewAllRecords"
                            >
                                <v-icon start>mdi-history</v-icon>
                                查看所有病假記錄
                            </v-btn>
                        </div>
                    </v-card-text>
                </v-card>

                <!-- 流程步驟 -->
                <v-card elevation="2">
                    <v-stepper v-model="currentStep" alt-labels>
                        <v-stepper-header>
                            <v-stepper-item
                                :complete="currentStep > 1"
                                :value="1"
                                color="deep-purple"
                            >
                                <template v-slot:icon>
                                    <v-icon>mdi-file-document-check</v-icon>
                                </template>
                                <template v-slot:title>
                                    驗證醫療證明
                                </template>
                            </v-stepper-item>

                            <v-divider></v-divider>

                            <v-stepper-item
                                :complete="currentStep > 2"
                                :value="2"
                                color="deep-purple"
                            >
                                <template v-slot:icon>
                                    <v-icon>mdi-calendar-edit</v-icon>
                                </template>
                                <template v-slot:title>
                                    填寫請假資料
                                </template>
                            </v-stepper-item>

                            <v-divider></v-divider>

                            <v-stepper-item
                                :value="3"
                                color="deep-purple"
                            >
                                <template v-slot:icon>
                                    <v-icon>mdi-check-circle</v-icon>
                                </template>
                                <template v-slot:title>
                                    申請成功
                                </template>
                            </v-stepper-item>
                        </v-stepper-header>

                        <v-stepper-window>
                            <!-- Step 1: 驗證醫療證明 -->
                            <v-stepper-window-item :value="1">
                                <v-card-text class="pa-8">
                                    <v-alert type="info" variant="tonal" prominent class="mb-6">
                                        <v-alert-title>申請流程說明</v-alert-title>
                                        <ol class="mt-2">
                                            <li>點擊「開始驗證」按鈕產生 QR Code</li>
                                            <li>使用數位憑證皮夾掃描 QR Code</li>
                                            <li>提交包含<strong>員工證</strong>及<strong>醫療診斷證明</strong>的 VP</li>
                                            <li>系統自動驗證並匯入資料</li>
                                        </ol>
                                    </v-alert>

                                    <v-alert type="warning" variant="tonal" border="start" class="mb-6">
                                        <v-alert-title>注意事項</v-alert-title>
                                        <ul class="mt-2">
                                            <li>員工證姓名必須與登入者一致</li>
                                            <li>請假起始日不得早於醫師建議休養起始日</li>
                                            <li>每張醫療證明只能使用一次</li>
                                        </ul>
                                    </v-alert>

                                    <div class="text-center">
                                        <v-icon size="120" color="deep-purple" class="mb-4">
                                            mdi-file-document-check-outline
                                        </v-icon>
                                        <div class="text-h5 mb-6">準備好您的醫療診斷證明</div>
                                        <v-btn
                                            size="x-large"
                                            color="deep-purple"
                                            variant="elevated"
                                            prepend-icon="mdi-qrcode-scan"
                                            @click="startVPVerification"
                                        >
                                            開始驗證
                                        </v-btn>
                                    </div>
                                </v-card-text>
                            </v-stepper-window-item>

                            <!-- Step 2: 填寫請假資料 -->
                            <v-stepper-window-item :value="2">
                                <v-card-text class="pa-8">
                                    <v-alert type="success" variant="tonal" class="mb-6">
                                        <v-alert-title>
                                            <v-icon>mdi-check-circle</v-icon>
                                            醫療證明驗證成功
                                        </v-alert-title>
                                        <div class="mt-2">已成功匯入醫師建議休養資料，請確認或調整請假日期。</div>
                                    </v-alert>

                                    <v-form ref="leaveForm">
                                        <!-- 醫師建議休養日期 -->
                                        <v-card variant="outlined" class="mb-6">
                                            <v-card-title class="bg-grey-lighten-4">
                                                <v-icon class="mr-2">mdi-doctor</v-icon>
                                                醫師建議休養日期
                                            </v-card-title>
                                            <v-card-text>
                                                <v-row>
                                                    <v-col cols="12" sm="6">
                                                        <v-text-field
                                                            v-model="formData.rest_start_date"
                                                            label="建議休養起始日"
                                                            prepend-inner-icon="mdi-calendar"
                                                            readonly
                                                            variant="outlined"
                                                            bg-color="grey-lighten-4"
                                                        />
                                                    </v-col>
                                                    <v-col cols="12" sm="6">
                                                        <v-text-field
                                                            v-model="formData.rest_end_date"
                                                            label="建議休養結束日"
                                                            prepend-inner-icon="mdi-calendar"
                                                            readonly
                                                            variant="outlined"
                                                            bg-color="grey-lighten-4"
                                                        />
                                                    </v-col>
                                                </v-row>
                                            </v-card-text>
                                        </v-card>

                                        <!-- 請假日期 -->
                                        <v-card variant="outlined" class="mb-6">
                                            <v-card-title class="bg-deep-purple-lighten-5">
                                                <v-icon class="mr-2">mdi-calendar-edit</v-icon>
                                                請假日期（可調整）
                                            </v-card-title>
                                            <v-card-text>
                                                <v-row>
                                                    <v-col cols="12" sm="6">
                                                        <v-text-field
                                                            v-model="formData.leave_start_date"
                                                            label="請假起始日 *"
                                                            prepend-inner-icon="mdi-calendar-start"
                                                            type="date"
                                                            variant="outlined"
                                                            :rules="leaveStartDateRules"
                                                            :min="formData.rest_start_date"
                                                            hint="不得早於醫師建議休養起始日"
                                                            persistent-hint
                                                        />
                                                    </v-col>
                                                    <v-col cols="12" sm="6">
                                                        <v-text-field
                                                            v-model="formData.leave_end_date"
                                                            label="請假結束日 *"
                                                            prepend-inner-icon="mdi-calendar-end"
                                                            type="date"
                                                            variant="outlined"
                                                            :rules="leaveEndDateRules"
                                                            :min="formData.leave_start_date"
                                                            hint="可提前結束，不一定要跟建議日期一樣"
                                                            persistent-hint
                                                        />
                                                    </v-col>
                                                </v-row>
                                            </v-card-text>
                                        </v-card>

                                        <!-- 醫療資訊 -->
                                        <v-card variant="outlined" class="mb-6">
                                            <v-card-title class="bg-grey-lighten-4">
                                                <v-icon class="mr-2">mdi-hospital-building</v-icon>
                                                醫療資訊
                                            </v-card-title>
                                            <v-card-text>
                                                <v-row>
                                                    <v-col cols="12" sm="6">
                                                        <v-text-field
                                                            v-model="formData.hospital_name"
                                                            label="醫療院所"
                                                            prepend-inner-icon="mdi-hospital-building"
                                                            readonly
                                                            variant="outlined"
                                                            bg-color="grey-lighten-4"
                                                        />
                                                    </v-col>
                                                    <v-col cols="12" sm="6">
                                                        <v-text-field
                                                            v-model="formData.doctor_name"
                                                            label="醫師姓名"
                                                            prepend-inner-icon="mdi-doctor"
                                                            readonly
                                                            variant="outlined"
                                                            bg-color="grey-lighten-4"
                                                        />
                                                    </v-col>
                                                    <v-col cols="12">
                                                        <v-textarea
                                                            v-model="formData.doctor_recommendation"
                                                            label="醫師建議"
                                                            prepend-inner-icon="mdi-text-box"
                                                            readonly
                                                            variant="outlined"
                                                            bg-color="grey-lighten-4"
                                                            rows="3"
                                                        />
                                                    </v-col>
                                                </v-row>
                                            </v-card-text>
                                        </v-card>
                                    </v-form>
                                </v-card-text>

                                <v-card-actions class="pa-6">
                                    <v-btn
                                        variant="outlined"
                                        @click="currentStep = 1"
                                    >
                                        上一步
                                    </v-btn>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="deep-purple"
                                        variant="elevated"
                                        size="large"
                                        @click="submitLeave"
                                        :loading="submitting"
                                    >
                                        提交病假申請
                                    </v-btn>
                                </v-card-actions>
                            </v-stepper-window-item>

                            <!-- Step 3: 申請成功 -->
                            <v-stepper-window-item :value="3">
                                <v-card-text class="pa-8 text-center">
                                    <v-icon size="120" color="success" class="mb-4">
                                        mdi-check-circle
                                    </v-icon>
                                    <div class="text-h4 mb-2">病假申請提交成功！</div>
                                    <div class="text-body-1 text-grey mb-6">
                                        您的病假申請已送出，請等待主管審核。
                                    </div>

                                    <v-alert type="info" variant="tonal" class="mb-6">
                                        <div class="text-body-2">
                                            審核結果將會記錄在系統中，您可以隨時在 Dashboard 查看審核進度。
                                        </div>
                                    </v-alert>

                                    <v-divider class="my-6"></v-divider>

                                    <!-- 病假記錄列表 -->
                                    <div v-if="leaveRecords.length > 0">
                                        <div class="text-h6 mb-4 text-left">
                                            <v-icon class="mr-2">mdi-history</v-icon>
                                            病假記錄
                                        </div>
                                        <v-list>
                                            <v-list-item
                                                v-for="(record, index) in leaveRecords"
                                                :key="record.id"
                                                class="mb-2"
                                                border
                                                rounded
                                            >
                                                <template v-slot:prepend>
                                                    <v-avatar :color="getStatusColor(record.status)" size="48">
                                                        <v-icon color="white">mdi-calendar-clock</v-icon>
                                                    </v-avatar>
                                                </template>

                                                <v-list-item-title class="font-weight-medium mb-1">
                                                    {{ record.leave_start_date }} ~ {{ record.leave_end_date }}
                                                </v-list-item-title>
                                                <v-list-item-subtitle>
                                                    請假天數：{{ record.leave_days }} 天 |
                                                    醫療院所：{{ record.hospital_name }}
                                                </v-list-item-subtitle>

                                                <template v-slot:append>
                                                    <v-chip
                                                        :color="getStatusColor(record.status)"
                                                        size="small"
                                                    >
                                                        {{ getStatusText(record.status) }}
                                                    </v-chip>
                                                </template>
                                            </v-list-item>
                                        </v-list>
                                    </div>

                                    <div class="mt-6">
                                        <v-btn
                                            color="deep-purple"
                                            variant="outlined"
                                            @click="resetAndApplyAgain"
                                            class="mr-3"
                                        >
                                            再次申請
                                        </v-btn>
                                        <v-btn
                                            color="primary"
                                            variant="elevated"
                                            @click="goBack"
                                        >
                                            返回 Dashboard
                                        </v-btn>
                                    </div>
                                </v-card-text>
                            </v-stepper-window-item>
                        </v-stepper-window>
                    </v-stepper>
                </v-card>
            </v-col>
        </v-row>

        <!-- VP 驗證對話框 -->
        <v-dialog v-model="showVPDialog" max-width="700" persistent>
            <v-card>
                <v-card-title class="bg-deep-purple">
                    <v-icon class="mr-2">mdi-qrcode-scan</v-icon>
                    驗證醫療診斷證明
                </v-card-title>
                <v-card-text class="pa-6">
                    <VPQRCodeScanner
                        ref="vpScanner"
                        vpRef="00000000_vp_medical_leave"
                        successMessage="醫療診斷證明驗證成功"
                        :autoStart="false"
                        @success="handleVPSuccess"
                        @error="handleVPError"
                    />
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn variant="text" @click="closeVPDialog">取消</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- 錯誤提示 -->
        <v-snackbar v-model="errorSnackbar" color="error" :timeout="5000">
            {{ errorMessage }}
            <template v-slot:actions>
                <v-btn variant="text" @click="errorSnackbar = false">關閉</v-btn>
            </template>
        </v-snackbar>
    </v-container>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import VPQRCodeScanner from '../components/VPQRCodeScanner.vue'

const router = useRouter()

// 流程步驟
const currentStep = ref(1)

// VP 驗證相關
const showVPDialog = ref(false)
const vpScanner = ref(null)

// 表單資料
const formData = ref({
    vp_transaction_id: '',
    rest_start_date: '',
    rest_end_date: '',
    leave_start_date: '',
    leave_end_date: '',
    hospital_name: '',
    doctor_name: '',
    doctor_recommendation: '',
})

// UI 狀態
const submitting = ref(false)
const errorSnackbar = ref(false)
const errorMessage = ref('')
const leaveRecords = ref([])
const leaveForm = ref(null)

// 表單驗證規則
const leaveStartDateRules = [
    v => !!v || '請選擇請假起始日',
    v => !formData.value.rest_start_date || v >= formData.value.rest_start_date || '請假起始日不得早於建議休養起始日',
]

const leaveEndDateRules = [
    v => !!v || '請選擇請假結束日',
    v => !formData.value.leave_start_date || v >= formData.value.leave_start_date || '請假結束日不得早於起始日',
]

// 計算屬性
const hasRecentLeave = computed(() => leaveRecords.value.length > 0)
const recentLeave = computed(() => leaveRecords.value[0] || null)

// 開始 VP 驗證
const startVPVerification = () => {
    showVPDialog.value = true
    setTimeout(() => {
        if (vpScanner.value) {
            vpScanner.value.start()
        }
    }, 100)
}

// 關閉 VP 對話框
const closeVPDialog = () => {
    showVPDialog.value = false
    if (vpScanner.value) {
        vpScanner.value.reset()
    }
}

// VP 驗證成功
const handleVPSuccess = async (result) => {
    showVPDialog.value = false

    try {
        // 呼叫後端 API 驗證並提取資料
        const token = localStorage.getItem('auth_token')
        const response = await fetch('/api/medical-leaves/verify-certificate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                vp_transaction_id: result.transactionId
            })
        })

        const data = await response.json()

        if (!response.ok || !data.success) {
            throw new Error(data.message || '驗證失敗')
        }

        // 填入表單資料
        formData.value = {
            vp_transaction_id: data.data.vp_transaction_id,
            rest_start_date: data.data.rest_start_date,
            rest_end_date: data.data.rest_end_date,
            leave_start_date: data.data.rest_start_date, // 預設跟建議日期一樣
            leave_end_date: data.data.rest_end_date, // 預設跟建議日期一樣
            hospital_name: data.data.hospital_name || '',
            doctor_name: data.data.doctor_name || '',
            doctor_recommendation: data.data.doctor_recommendation || '',
        }

        // 進入下一步
        currentStep.value = 2

    } catch (error) {
        errorMessage.value = error.message
        errorSnackbar.value = true
    }
}

// VP 驗證失敗
const handleVPError = (error) => {
    errorMessage.value = error
    errorSnackbar.value = true
}

// 提交請假申請
const submitLeave = async () => {
    // 驗證表單
    const { valid } = await leaveForm.value.validate()
    if (!valid) {
        return
    }

    submitting.value = true

    try {
        const token = localStorage.getItem('auth_token')
        const response = await fetch('/api/medical-leaves', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify(formData.value)
        })

        const data = await response.json()

        if (!response.ok || !data.success) {
            throw new Error(data.message || '提交失敗')
        }

        // 進入成功步驟
        currentStep.value = 3

        // 重新載入請假記錄
        await fetchLeaveRecords()

    } catch (error) {
        errorMessage.value = error.message
        errorSnackbar.value = true
    } finally {
        submitting.value = false
    }
}

// 重置並再次申請
const resetAndApplyAgain = () => {
    formData.value = {
        vp_transaction_id: '',
        rest_start_date: '',
        rest_end_date: '',
        leave_start_date: '',
        leave_end_date: '',
        hospital_name: '',
        doctor_name: '',
        doctor_recommendation: '',
    }
    if (leaveForm.value) {
        leaveForm.value.resetValidation()
    }
    currentStep.value = 1
}

// 查看所有記錄
const viewAllRecords = () => {
    currentStep.value = 3
}

// 獲取請假記錄
const fetchLeaveRecords = async () => {
    try {
        const token = localStorage.getItem('auth_token')
        const response = await fetch('/api/medical-leaves', {
            headers: {
                'Authorization': `Bearer ${token}`,
            }
        })

        const data = await response.json()

        if (response.ok && data.success) {
            leaveRecords.value = data.data
        }
    } catch (error) {
        console.error('Failed to fetch leave records:', error)
    }
}

// 取得狀態顏色
const getStatusColor = (status) => {
    switch (status) {
        case 'pending':
            return 'warning'
        case 'approved':
            return 'success'
        case 'rejected':
            return 'error'
        default:
            return 'grey'
    }
}

// 取得狀態文字
const getStatusText = (status) => {
    switch (status) {
        case 'pending':
            return '待審核'
        case 'approved':
            return '已核准'
        case 'rejected':
            return '已拒絕'
        default:
            return '未知'
    }
}

// 返回
const goBack = () => {
    router.push({ name: 'Dashboard' })
}

// 初始化
onMounted(() => {
    fetchLeaveRecords()
})
</script>

<style scoped>
.medical-leave-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 40px 20px;
}
</style>
