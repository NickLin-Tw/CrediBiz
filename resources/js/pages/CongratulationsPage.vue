<template>
    <v-container class="congratulations-page">
        <v-row justify="center" align="center" class="fill-height">
            <v-col cols="12" md="8" lg="6">
                <v-card class="pa-8" elevation="3" rounded="lg">
                    <!-- 返回首頁按鈕 -->
                    <v-btn
                        icon="mdi-home"
                        variant="text"
                        @click="goHome"
                        class="mb-4"
                    />

                    <!-- 載入中 -->
                    <div v-if="loading" class="text-center py-8">
                        <v-progress-circular
                            indeterminate
                            color="primary"
                            size="64"
                        ></v-progress-circular>
                        <p class="mt-4">載入中...</p>
                    </div>

                    <!-- 錯誤訊息 -->
                    <v-alert v-if="error && !loading" type="error" variant="tonal" class="mb-4">
                        無法取得員工資料，將自動返回首頁...
                    </v-alert>

                    <!-- 恭喜圖示 -->
                    <div v-if="!loading && !error" class="text-center mb-6">
                        <div class="success-icon-wrapper">
                            <v-icon size="100" color="success" class="success-icon">
                                mdi-check-circle
                            </v-icon>
                        </div>
                        <h1 class="text-h3 mt-6 mb-2 congratulations-title">恭喜您！</h1>
                        <p class="text-h6 text-medium-emphasis">您已成功錄取</p>
                    </div>

                    <!-- 員工資訊卡片 -->
                    <v-card v-if="!loading && !error" variant="tonal" class="mb-6">
                        <v-card-text>
                            <v-list lines="two" bg-color="transparent">
                                <v-list-item>
                                    <v-list-item-title class="text-caption text-medium-emphasis">
                                        員工編號
                                    </v-list-item-title>
                                    <v-list-item-subtitle class="text-h6 font-weight-bold">
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
                                        職位
                                    </v-list-item-title>
                                    <v-list-item-subtitle class="text-body-1">
                                        {{ employeeData.position }}
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
                                        到職日期
                                    </v-list-item-title>
                                    <v-list-item-subtitle class="text-body-1">
                                        {{ employeeData.employment_start_date }}
                                    </v-list-item-subtitle>
                                </v-list-item>
                            </v-list>
                        </v-card-text>
                    </v-card>

                    <!-- 下一步提示 -->
                    <v-alert
                        v-if="!loading && !error"
                        type="info"
                        variant="tonal"
                        prominent
                        class="mb-6"
                    >
                        <v-alert-title>下一步</v-alert-title>
                        <div>請前往領取您的員工數位憑證（員工證明 VC），以便日後登入系統。</div>
                    </v-alert>

                    <!-- 按鈕組 -->
                    <div v-if="!loading && !error" class="d-flex flex-column gap-3">
                        <v-btn
                            color="primary"
                            variant="elevated"
                            size="large"
                            @click="goToEmployeeCredential"
                            prepend-icon="mdi-card-account-details"
                        >
                            領取員工數位憑證
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

const router = useRouter()
const route = useRoute()

const employeeData = ref({
    employee_id: '',
    credential_token: '',
    name: '',
    position: '',
    department: '',
    employment_start_date: '',
})

const loading = ref(true)
const error = ref(false)

onMounted(async () => {
    // 從路由 query 取得員工 ID 和 token
    const employeeId = route.query.employee_id
    const token = route.query.token

    if (!employeeId || !token) {
        // 如果缺少參數，返回首頁
        router.push({ name: 'Home' })
        return
    }

    // 向後端查詢員工資料
    try {
        const response = await fetch(`/api/employees/${employeeId}?token=${encodeURIComponent(token)}`)

        if (!response.ok) {
            throw new Error('無法取得員工資料')
        }

        const data = await response.json()
        employeeData.value = {
            employee_id: data.employee.employee_id,
            credential_token: token,
            name: data.employee.name,
            position: data.employee.position,
            department: data.employee.department,
            employment_start_date: data.employee.employment_start_date,
        }
    } catch (e) {
        console.error('Failed to fetch employee data:', e)
        error.value = true
        // 3 秒後返回首頁
        setTimeout(() => {
            router.push({ name: 'Home' })
        }, 3000)
    } finally {
        loading.value = false
    }
})

const goHome = () => {
    router.push({ name: 'Home' })
}

const goToEmployeeCredential = () => {
    router.push({
        name: 'EmployeeCredential',
        query: {
            employee_id: employeeData.value.employee_id,
            token: employeeData.value.credential_token,
        },
    })
}
</script>

<style scoped>
.congratulations-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.success-icon-wrapper {
    display: inline-block;
    animation: scaleIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.success-icon {
    filter: drop-shadow(0 4px 8px rgba(76, 175, 80, 0.3));
}

.congratulations-title {
    background: linear-gradient(135deg, #4caf50 0%, #2e7d32 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: fadeInDown 0.6s ease-out 0.2s both;
}

@keyframes scaleIn {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes fadeInDown {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.gap-3 {
    gap: 12px;
}
</style>
