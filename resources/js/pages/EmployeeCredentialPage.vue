<template>
    <v-container class="employee-credential-page">
        <v-row justify="center" align="center" class="fill-height">
            <v-col cols="12" md="8" lg="6">
                <v-card class="pa-8" elevation="3" rounded="lg">
                    <!-- 返回按鈕 -->
                    <v-btn
                        icon="mdi-arrow-left"
                        variant="text"
                        @click="goBack"
                        class="mb-4"
                    />

                    <!-- 標題區域 -->
                    <div class="text-center mb-8">
                        <v-icon size="80" color="primary">
                            mdi-badge-account
                        </v-icon>
                        <h1 class="text-h4 mt-4 mb-2">領取員工數位憑證</h1>
                        <p class="text-subtitle-1 text-medium-emphasis">
                            員工證明 VC（Verifiable Credential）
                        </p>
                    </div>

                    <!-- 錯誤訊息 -->
                    <v-alert
                        v-if="showError"
                        type="error"
                        variant="tonal"
                        closable
                        @click:close="showError = false"
                        class="mb-4"
                    >
                        {{ errorMessage }}
                    </v-alert>

                    <!-- 員工資訊 -->
                    <v-card v-if="employeeData" variant="tonal" class="mb-6">
                        <v-card-text>
                            <v-list lines="two" bg-color="transparent">
                                <v-list-item>
                                    <v-list-item-title class="text-caption text-medium-emphasis">
                                        員工編號
                                    </v-list-item-title>
                                    <v-list-item-subtitle class="text-body-1 font-weight-bold">
                                        {{ employeeData.employee_id }}
                                    </v-list-item-subtitle>
                                </v-list-item>

                                <v-divider />

                                <v-list-item>
                                    <v-list-item-title class="text-caption text-medium-emphasis">
                                        姓名
                                    </v-list-item-title>
                                    <v-list-item-subtitle class="text-body-1">
                                        {{ employeeData.name }}
                                    </v-list-item-subtitle>
                                </v-list-item>

                                <v-divider />

                                <v-list-item>
                                    <v-list-item-title class="text-caption text-medium-emphasis">
                                        部門
                                    </v-list-item-title>
                                    <v-list-item-subtitle class="text-body-1">
                                        {{ employeeData.department }}
                                    </v-list-item-subtitle>
                                </v-list-item>

                                <v-divider />

                                <v-list-item>
                                    <v-list-item-title class="text-caption text-medium-emphasis">
                                        職位
                                    </v-list-item-title>
                                    <v-list-item-subtitle class="text-body-1">
                                        {{ employeeData.position }}
                                    </v-list-item-subtitle>
                                </v-list-item>

                                <v-divider />

                                <v-list-item>
                                    <v-list-item-title class="text-caption text-medium-emphasis">
                                        公司名稱
                                    </v-list-item-title>
                                    <v-list-item-subtitle class="text-body-1">
                                        {{ employeeData.company_name }}
                                    </v-list-item-subtitle>
                                </v-list-item>
                            </v-list>
                        </v-card-text>
                    </v-card>

                    <!-- 已發行提示訊息 -->
                    <v-alert
                        v-if="employeeData?.credential_issued"
                        type="success"
                        variant="tonal"
                        prominent
                        class="mb-4"
                    >
                        <v-alert-title>✓ 憑證已發行</v-alert-title>
                        <div>您已經領取過員工數位憑證，無法重複領取。</div>
                    </v-alert>

                    <!-- 使用 VC QR Code Scanner 元件 -->
                    <VCQRCodeScanner
                        v-if="employeeData && !employeeData.credential_issued"
                        api-endpoint="/api/employee-credentials/issue"
                        status-endpoint="/api/test/vc/status/{transactionId}"
                        :request-payload="{ employee_id: employeeData.employee_id }"
                        button-text="產生領取 QR Code"
                        success-message="您的員工數位憑證已成功發行，現在可以使用此憑證登入系統。"
                        @success="handleSuccess"
                        @error="handleError"
                    />

                    <!-- 成功後的按鈕 -->
                    <div v-if="credentialIssued || employeeData?.credential_issued" class="d-flex flex-column gap-3 mt-6">
                        <v-btn
                            color="primary"
                            variant="elevated"
                            size="large"
                            @click="goToLogin"
                            prepend-icon="mdi-login"
                        >
                            前往登入
                        </v-btn>

                        <v-btn
                            color="secondary"
                            variant="outlined"
                            size="large"
                            @click="goHome"
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
import { useRouter, useRoute } from 'vue-router'
import VCQRCodeScanner from '@/components/VCQRCodeScanner.vue'

const router = useRouter()
const route = useRoute()

const employeeData = ref(null)
const showError = ref(false)
const errorMessage = ref('')
const credentialIssued = ref(false)

onMounted(async () => {
    // 從路由 query 取得員工編號和 token
    const employeeId = route.query.employee_id
    const token = route.query.token

    if (!employeeId) {
        errorMessage.value = '缺少員工編號'
        showError.value = true
        return
    }

    if (!token) {
        errorMessage.value = '缺少驗證 token'
        showError.value = true
        return
    }

    // 取得員工資料
    await fetchEmployeeData(employeeId, token)
})

// 取得員工資料
const fetchEmployeeData = async (employeeId, token) => {
    try {
        const response = await fetch(`/api/employees/${employeeId}?token=${encodeURIComponent(token)}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        })

        if (!response.ok) {
            const data = await response.json()
            throw new Error(data.message || '無法取得員工資料')
        }

        const data = await response.json()
        employeeData.value = data.employee
    } catch (error) {
        errorMessage.value = error.message
        showError.value = true
    }
}

// 處理 VC 發行成功
const handleSuccess = async ({ cid, transactionId }) => {
    try {
        // 更新員工憑證資料
        const response = await fetch(`/api/employees/${employeeData.value.employee_id}/credential`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                employee_vc_transaction_id: transactionId,
                employee_vc_cid: cid
            })
        })

        if (!response.ok) {
            throw new Error('更新員工憑證資料失敗')
        }

        credentialIssued.value = true
    } catch (error) {
        errorMessage.value = error.message
        showError.value = true
    }
}

// 處理錯誤
const handleError = (error) => {
    errorMessage.value = error
    showError.value = true
}

// 導航
const goBack = () => {
    router.back()
}

const goHome = () => {
    router.push({ name: 'Home' })
}

const goToLogin = () => {
    router.push({ name: 'Login' })
}
</script>

<style scoped>
.employee-credential-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
}

.gap-3 {
    gap: 12px;
}
</style>
