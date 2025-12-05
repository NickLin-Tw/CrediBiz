<template>
    <v-container fluid class="home-page">
        <v-row justify="center" align="center" class="fill-height">
            <v-col cols="12" md="8" lg="6" class="text-center">
                <!-- Logo 區域 -->
                <div class="logo-container">
                    <!-- 飛機圖騰 -->
                    <div class="plane-icon">
                        <svg width="120" height="120" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"
                                  fill="currentColor"
                                  class="plane-path"/>
                        </svg>
                    </div>

                    <!-- CrediBiz 標題 -->
                    <h1 class="app-title">CrediBiz</h1>
                    <p class="app-subtitle">臺灣航空</p>
                </div>

                <!-- 按鈕區域 -->
                <div class="action-buttons">
                    <v-btn
                        size="x-large"
                        color="primary"
                        variant="elevated"
                        rounded="lg"
                        class="action-btn"
                        @click="goToGovernmentVC"
                    >
                        <v-icon start>mdi-card-account-details</v-icon>
                        領取前置 VC
                    </v-btn>

                    <v-btn
                        size="x-large"
                        color="secondary"
                        variant="elevated"
                        rounded="lg"
                        class="action-btn"
                        @click="goToApply"
                    >
                        <v-icon start>mdi-briefcase-check</v-icon>
                        應徵職位
                    </v-btn>

                    <v-btn
                        size="x-large"
                        color="orange-darken-2"
                        variant="elevated"
                        rounded="lg"
                        class="action-btn"
                        @click="goToAirportPOS"
                    >
                        <v-icon start>mdi-store</v-icon>
                        機場特約商店 POS
                    </v-btn>

                    <v-btn
                        size="x-large"
                        color="teal"
                        variant="elevated"
                        rounded="lg"
                        class="action-btn"
                        @click="showVisitorParkingDialog = true"
                    >
                        <v-icon start>mdi-car-parking-lights</v-icon>
                        訪客停車證申請
                    </v-btn>

                    <v-btn
                        size="x-large"
                        :color="isLoggedIn ? 'info' : 'success'"
                        variant="elevated"
                        rounded="lg"
                        class="action-btn"
                        @click="goToLogin"
                    >
                        <v-icon start>{{ isLoggedIn ? 'mdi-view-dashboard' : 'mdi-login' }}</v-icon>
                        {{ isLoggedIn ? '前往 Dashboard' : '登入內部系統' }}
                    </v-btn>
                </div>

                <!-- 裝飾性元素 -->
                <div class="decoration-dots">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </v-col>
        </v-row>

        <!-- 訪客停車證申請對話框 -->
        <v-dialog v-model="showVisitorParkingDialog" max-width="600" persistent>
            <v-card>
                <v-card-title class="d-flex align-center bg-teal">
                    <v-icon class="mr-2">mdi-car-parking-lights</v-icon>
                    訪客停車證申請
                </v-card-title>

                <v-card-text class="pt-6">
                    <v-form ref="visitorParkingForm" v-model="formValid">
                        <!-- 姓名 -->
                        <v-text-field
                            v-model="visitorParkingData.name"
                            label="姓名 *"
                            prepend-inner-icon="mdi-account"
                            :rules="[v => !!v || '請輸入姓名']"
                            required
                            variant="outlined"
                            class="mb-2"
                        ></v-text-field>

                        <!-- 電子郵件 -->
                        <v-text-field
                            v-model="visitorParkingData.email"
                            label="電子郵件 *"
                            type="email"
                            prepend-inner-icon="mdi-email"
                            :rules="[
                                v => !!v || '請輸入電子郵件',
                                v => /.+@.+\..+/.test(v) || '請輸入有效的電子郵件地址'
                            ]"
                            required
                            variant="outlined"
                            class="mb-2"
                        ></v-text-field>

                        <!-- 申請原因 -->
                        <v-textarea
                            v-model="visitorParkingData.application_reason"
                            label="申請原因 *"
                            prepend-inner-icon="mdi-text"
                            :rules="[v => !!v || '請輸入申請原因']"
                            required
                            variant="outlined"
                            rows="3"
                            class="mb-2"
                        ></v-textarea>

                        <!-- 車牌號碼 -->
                        <v-text-field
                            v-model="visitorParkingData.vehicle_plate_number"
                            label="車牌號碼 *"
                            prepend-inner-icon="mdi-card-text"
                            :rules="[v => !!v || '請輸入車牌號碼']"
                            required
                            variant="outlined"
                            class="mb-2"
                        ></v-text-field>

                        <!-- 車種 -->
                        <v-select
                            v-model="visitorParkingData.vehicle_type"
                            label="車種 *"
                            prepend-inner-icon="mdi-car"
                            :items="['小客車', '機車', 'SUV', '貨車', '其他']"
                            :rules="[v => !!v || '請選擇車種']"
                            required
                            variant="outlined"
                            class="mb-2"
                        ></v-select>

                        <!-- 廠牌與車型 -->
                        <v-text-field
                            v-model="visitorParkingData.brand_model"
                            label="廠牌與車型 *"
                            prepend-inner-icon="mdi-car-info"
                            :rules="[v => !!v || '請輸入廠牌與車型']"
                            required
                            variant="outlined"
                            class="mb-2"
                        ></v-text-field>

                        <!-- 車色 -->
                        <v-text-field
                            v-model="visitorParkingData.color"
                            label="車色 *"
                            prepend-inner-icon="mdi-palette"
                            :rules="[v => !!v || '請輸入車色']"
                            required
                            variant="outlined"
                            class="mb-2"
                        ></v-text-field>

                        <!-- 停車起始日 -->
                        <v-text-field
                            v-model="visitorParkingData.parking_start_date"
                            label="停車起始日 *"
                            type="date"
                            prepend-inner-icon="mdi-calendar-start"
                            :rules="[
                                v => !!v || '請選擇停車起始日',
                                v => !v || new Date(v) >= new Date(new Date().setHours(0,0,0,0)) || '停車起始日不能早於今天'
                            ]"
                            required
                            variant="outlined"
                            class="mb-2"
                        ></v-text-field>

                        <!-- 停車結束日 -->
                        <v-text-field
                            v-model="visitorParkingData.parking_end_date"
                            label="停車結束日 *"
                            type="date"
                            prepend-inner-icon="mdi-calendar-end"
                            :rules="[
                                v => !!v || '請選擇停車結束日',
                                v => !v || !visitorParkingData.parking_start_date || new Date(v) >= new Date(visitorParkingData.parking_start_date) || '停車結束日不能早於起始日'
                            ]"
                            required
                            variant="outlined"
                            class="mb-2"
                        ></v-text-field>

                        <v-alert type="info" variant="tonal" class="mt-4">
                            <div class="text-body-2">
                                <strong>注意事項：</strong><br>
                                1. 申請送出後將由管理員審核<br>
                                2. 審核結果將寄送至您的電子郵件<br>
                                3. 核准後，您將收到停車證領取連結
                            </div>
                        </v-alert>
                    </v-form>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        variant="text"
                        @click="closeVisitorParkingDialog"
                        :disabled="submitting"
                    >
                        取消
                    </v-btn>
                    <v-btn
                        color="teal"
                        variant="elevated"
                        @click="submitVisitorParkingApplication"
                        :loading="submitting"
                        :disabled="!formValid"
                    >
                        送出申請
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- 成功提示對話框 -->
        <v-dialog v-model="showSuccessDialog" max-width="500">
            <v-card>
                <v-card-title class="d-flex align-center bg-success">
                    <v-icon class="mr-2">mdi-check-circle</v-icon>
                    申請成功
                </v-card-title>
                <v-card-text class="pt-6">
                    <v-alert type="success" variant="tonal">
                        <div class="text-body-1">
                            <strong>您的訪客停車證申請已送出！</strong><br><br>
                            申請編號：#{{ applicationId }}<br>
                            電子郵件：{{ visitorParkingData.email }}<br><br>
                            管理員將盡快審核您的申請，審核結果將寄送至您的電子郵件。<br>
                            核准後，您將收到停車證領取連結，請使用 TW-DIW 數位皮夾掃描領取。
                        </div>
                    </v-alert>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="success" variant="elevated" @click="showSuccessDialog = false">
                        確定
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()
const isLoggedIn = ref(false)

// 訪客停車證申請相關
const showVisitorParkingDialog = ref(false)
const showSuccessDialog = ref(false)
const formValid = ref(false)
const submitting = ref(false)
const applicationId = ref(null)
const visitorParkingForm = ref(null)

const visitorParkingData = ref({
    name: '王小明',
    email: 'visitor@example.com',
    application_reason: '拜訪公司洽談業務合作事宜',
    vehicle_plate_number: 'ABC-1234',
    vehicle_type: '小客車',
    brand_model: 'Toyota Camry',
    color: '白色',
    parking_start_date: new Date().toISOString().split('T')[0],
    parking_end_date: new Date(Date.now() + 7 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
})

onMounted(() => {
    // 檢查登入狀態
    const token = localStorage.getItem('auth_token')
    isLoggedIn.value = !!token
})

const goToGovernmentVC = () => {
    router.push({ name: 'PrerequisiteVC' })
}

const goToApply = () => {
    router.push({ name: 'Apply' })
}

const goToAirportPOS = () => {
    router.push({ name: 'AirportPOS' })
}

const goToLogin = () => {
    if (isLoggedIn.value) {
        // 已登入，直接跳轉到 Dashboard
        router.push({ name: 'Dashboard' })
    } else {
        // 未登入，跳轉到登入頁
        router.push({ name: 'Login' })
    }
}

const closeVisitorParkingDialog = () => {
    showVisitorParkingDialog.value = false
    // 重置表單
    visitorParkingForm.value?.reset()
    visitorParkingData.value = {
        email: '',
        application_reason: '',
        vehicle_plate_number: '',
        vehicle_type: '',
        brand_model: '',
        color: '',
        parking_start_date: '',
        parking_end_date: '',
    }
}

const submitVisitorParkingApplication = async () => {
    // 驗證表單
    const { valid } = await visitorParkingForm.value.validate()
    if (!valid) {
        return
    }

    submitting.value = true

    try {
        const response = await axios.post('/api/visitor-parking/applications', visitorParkingData.value)

        if (response.data.success) {
            applicationId.value = response.data.data.id
            showVisitorParkingDialog.value = false
            showSuccessDialog.value = true

            // 重置表單
            visitorParkingForm.value?.reset()
            visitorParkingData.value = {
                email: '',
                application_reason: '',
                vehicle_plate_number: '',
                vehicle_type: '',
                brand_model: '',
                color: '',
                parking_start_date: '',
                parking_end_date: '',
            }
        }
    } catch (error) {
        console.error('提交訪客停車證申請失敗:', error)
        alert(error.response?.data?.message || '提交申請時發生錯誤，請稍後再試')
    } finally {
        submitting.value = false
    }
}
</script>

<style scoped>
.home-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

/* 背景動畫效果 */
.home-page::before {
    content: '';
    position: absolute;
    width: 500px;
    height: 500px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    top: -250px;
    right: -250px;
    animation: float 20s infinite ease-in-out;
}

.home-page::after {
    content: '';
    position: absolute;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 50%;
    bottom: -150px;
    left: -150px;
    animation: float 15s infinite ease-in-out reverse;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(10deg);
    }
}

.fill-height {
    min-height: 100vh;
}

.logo-container {
    margin-bottom: 60px;
    animation: fadeInDown 1s ease-out;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.plane-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 30px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    color: white;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }
}

.plane-path {
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.app-title {
    font-size: 72px;
    font-weight: 800;
    color: white;
    margin-bottom: 16px;
    text-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    letter-spacing: -2px;
}

.app-subtitle {
    font-size: 20px;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
    letter-spacing: 4px;
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 20px;
    max-width: 400px;
    margin: 0 auto;
    animation: fadeInUp 1s ease-out 0.3s both;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.action-btn {
    text-transform: none !important;
    font-size: 18px !important;
    font-weight: 600 !important;
    padding: 28px 40px !important;
    letter-spacing: 0.5px !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.action-btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25) !important;
}

.decoration-dots {
    display: flex;
    gap: 12px;
    justify-content: center;
    margin-top: 60px;
    animation: fadeIn 1s ease-out 0.6s both;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.dot {
    width: 8px;
    height: 8px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    animation: dotPulse 1.5s infinite;
}

.dot:nth-child(2) {
    animation-delay: 0.2s;
}

.dot:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes dotPulse {
    0%, 100% {
        opacity: 0.5;
        transform: scale(1);
    }
    50% {
        opacity: 1;
        transform: scale(1.2);
    }
}

/* 響應式設計 */
@media (max-width: 600px) {
    .app-title {
        font-size: 48px;
    }

    .app-subtitle {
        font-size: 16px;
        letter-spacing: 2px;
    }

    .action-btn {
        font-size: 16px !important;
        padding: 24px 32px !important;
    }
}
</style>
