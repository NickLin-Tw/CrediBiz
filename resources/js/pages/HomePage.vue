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
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const isLoggedIn = ref(false)

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

const goToLogin = () => {
    if (isLoggedIn.value) {
        // 已登入，直接跳轉到 Dashboard
        router.push({ name: 'Dashboard' })
    } else {
        // 未登入，跳轉到登入頁
        router.push({ name: 'Login' })
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
