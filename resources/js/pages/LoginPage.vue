<template>
    <v-container class="login-page">
        <v-row justify="center" align="center" class="fill-height">
            <v-col cols="12" md="6" lg="5">
                <v-card class="pa-8" elevation="3" rounded="lg">
                    <!-- 返回首頁按鈕 -->
                    <v-btn
                        icon="mdi-home"
                        variant="text"
                        @click="goHome"
                        class="mb-4"
                    />

                    <!-- 標題區域 -->
                    <div class="text-center mb-8">
                        <div class="logo-wrapper">
                            <v-icon size="80" color="primary">
                                mdi-login
                            </v-icon>
                        </div>
                        <h1 class="text-h4 mt-4 mb-2">員工登入</h1>
                        <p class="text-subtitle-1 text-medium-emphasis">
                            使用員工數位憑證登入
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

                    <!-- 使用 VP QR Code Scanner 元件 -->
                    <VPQRCodeScanner
                        vp-ref="00000000_vp_employee_login"
                        success-message="登入成功！正在跳轉..."
                        :auto-start="true"
                        @success="handleLoginSuccess"
                        @error="handleError"
                    />
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import VPQRCodeScanner from '@/components/VPQRCodeScanner.vue'

const router = useRouter()

const showError = ref(false)
const errorMessage = ref('')

// 檢查是否已登入
onMounted(() => {
    const token = localStorage.getItem('auth_token')
    if (token) {
        // 已登入，直接跳轉到 Dashboard
        router.push({ name: 'Dashboard' })
    }
})

// 處理登入成功
const handleLoginSuccess = async ({ transactionId }) => {
    try {
        // 呼叫登入 API
        const response = await fetch('/api/auth/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                vp_transaction_id: transactionId
            })
        })

        const data = await response.json()

        if (!response.ok) {
            throw new Error(data.message || '登入失敗')
        }

        // 儲存 Token 和員工資訊到 localStorage
        localStorage.setItem('auth_token', data.token)
        localStorage.setItem('employee_id', data.employee.employee_id)
        localStorage.setItem('employee_name', data.employee.name)
        localStorage.setItem('employee_department', data.employee.department)
        localStorage.setItem('employee_position', data.employee.position)
        localStorage.setItem('employee_company', data.employee.company_name)

        // 跳轉到 Dashboard
        router.push({ name: 'Dashboard' })
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
const goHome = () => {
    router.push({ name: 'Home' })
}
</script>

<style scoped>
.login-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.logo-wrapper {
    display: inline-block;
    padding: 20px;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 50%;
}
</style>
