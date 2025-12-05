<template>
    <div class="vc-qr-scanner">
        <!-- 使用說明 -->
        <v-alert
            v-if="!qrCode && !success"
            type="info"
            variant="tonal"
            class="mb-6"
        >
            <v-alert-title>如何領取？</v-alert-title>
            <ol class="mt-2">
                <li>打開數位憑證皮夾 App，選擇「掃描」</li>
                <li>掃描 QR Code，並確認授權內容後送出</li>
            </ol>
        </v-alert>

        <!-- QR Code 顯示區域 -->
        <div v-if="!success && qrCode" class="mb-6">
            <div class="qr-code-wrapper">
                <img :src="qrCode" alt="VC QR Code" class="qr-code-image" />
            </div>

            <!-- 倒數計時 -->
            <div class="text-center mt-4">
                <div
                    :class="[
                        'countdown-timer',
                        { 'warning': remainingSeconds <= 60 && remainingSeconds > 30 },
                        { 'danger': remainingSeconds <= 30 }
                    ]"
                >
                    {{ formatTime(remainingSeconds) }}
                </div>
                <div class="text-caption text-medium-emphasis">
                    請在時間內使用 TW-DIW App 掃描此 QR Code
                </div>
            </div>

            <!-- 按鈕組 -->
            <div class="d-flex flex-column gap-3 mt-4">
                <v-btn
                    v-if="deepLink"
                    color="success"
                    variant="elevated"
                    size="large"
                    :href="deepLink"
                    prepend-icon="mdi-wallet"
                >
                    直接以數位憑證皮夾開啟
                </v-btn>
                <v-btn
                    v-if="remainingSeconds > 0"
                    color="primary"
                    variant="outlined"
                    @click="regenerate"
                    :loading="loading"
                    prepend-icon="mdi-refresh"
                >
                    重新產生 QR Code
                </v-btn>
                <v-btn
                    v-if="remainingSeconds === 0"
                    color="primary"
                    variant="elevated"
                    @click="regenerate"
                    :loading="loading"
                >
                    重新產生 QR Code
                </v-btn>
            </div>
        </div>

        <!-- 初始產生按鈕 -->
        <v-btn
            v-if="!qrCode && !success && showInitialButton"
            color="primary"
            variant="elevated"
            size="large"
            block
            @click="generate"
            :loading="loading"
            prepend-icon="mdi-qrcode"
        >
            {{ buttonText }}
        </v-btn>

        <!-- 成功訊息 -->
        <v-alert
            v-if="success"
            type="success"
            variant="tonal"
            prominent
            class="mb-4"
        >
            <v-alert-title class="d-flex align-center">
                <v-icon color="success" class="mr-2" size="large">mdi-check-circle</v-icon>
                {{ successMessage }}
            </v-alert-title>
            <div class="text-caption mt-2 text-medium-emphasis">
                視窗將在 {{ autoCloseCountdown }} 秒後自動關閉
            </div>
        </v-alert>
    </div>
</template>

<script setup>
import { ref, onBeforeUnmount } from 'vue'

const props = defineProps({
    // API endpoint for generating QR code
    apiEndpoint: {
        type: String,
        required: false
    },
    // API endpoint for checking status
    statusEndpoint: {
        type: String,
        required: true
    },
    // Request payload for generating QR code
    requestPayload: {
        type: Object,
        default: () => ({})
    },
    // Pre-generated QR code data (to skip API call)
    preGeneratedData: {
        type: Object,
        default: null
    },
    // Button text
    buttonText: {
        type: String,
        default: '產生領取 QR Code'
    },
    // Success message
    successMessage: {
        type: String,
        default: '您的數位憑證已成功發行'
    },
    // Show initial generate button
    showInitialButton: {
        type: Boolean,
        default: true
    },
    // Auto generate on mount
    autoGenerate: {
        type: Boolean,
        default: false
    },
    // Polling interval in milliseconds
    pollingInterval: {
        type: Number,
        default: 3000
    },
    // QR code timeout in seconds
    timeout: {
        type: Number,
        default: 180
    }
})

const emit = defineEmits(['success', 'error', 'generated', 'auto-close'])

const loading = ref(false)
const qrCode = ref('')
const deepLink = ref('')
const transactionId = ref('')
const remainingSeconds = ref(0)
const success = ref(false)
const autoCloseCountdown = ref(5)

let countdownInterval = null
let pollingInterval = null
let autoCloseInterval = null

// 產生 QR Code
const generate = async () => {
    loading.value = true

    try {
        const response = await fetch(props.apiEndpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify(props.requestPayload)
        })

        const data = await response.json()

        if (!response.ok) {
            throw new Error(data.message || '產生 QR Code 失敗')
        }

        qrCode.value = data.qrCode
        deepLink.value = data.deepLink || null
        transactionId.value = data.transactionId

        remainingSeconds.value = props.timeout
        startCountdown()
        startPolling()

        emit('generated', { transactionId: transactionId.value, data })
    } catch (error) {
        emit('error', error.message)
    } finally {
        loading.value = false
    }
}

// 重新產生
const regenerate = () => {
    clearTimers()
    qrCode.value = ''
    deepLink.value = ''
    transactionId.value = ''
    remainingSeconds.value = 0
    generate()
}

// 開始倒數計時
const startCountdown = () => {
    clearInterval(countdownInterval)
    countdownInterval = setInterval(() => {
        remainingSeconds.value--
        if (remainingSeconds.value <= 0) {
            clearTimers()
        }
    }, 1000)
}

// 開始輪詢
const startPolling = () => {
    clearInterval(pollingInterval)
    pollingInterval = setInterval(async () => {
        try {
            const endpoint = props.statusEndpoint.replace('{transactionId}', transactionId.value)
            const response = await fetch(endpoint)
            const data = await response.json()

            // Check if credential is issued (has CID)
            if (response.ok && data.cid) {
                clearTimers()
                success.value = true
                emit('success', { cid: data.cid, transactionId: transactionId.value, data })

                // 開始自動關閉倒數計時
                startAutoCloseCountdown()
            }
        } catch (error) {
            console.error('輪詢錯誤:', error)
        }
    }, props.pollingInterval)
}

// 開始自動關閉倒數計時
const startAutoCloseCountdown = () => {
    autoCloseCountdown.value = 5
    clearInterval(autoCloseInterval)
    autoCloseInterval = setInterval(() => {
        autoCloseCountdown.value--
        if (autoCloseCountdown.value <= 0) {
            clearInterval(autoCloseInterval)
            autoCloseInterval = null
            emit('auto-close')
        }
    }, 1000)
}

// 格式化時間
const formatTime = (seconds) => {
    const mins = Math.floor(seconds / 60)
    const secs = seconds % 60
    return `${mins}:${secs.toString().padStart(2, '0')}`
}

// 清除計時器
const clearTimers = () => {
    if (countdownInterval) {
        clearInterval(countdownInterval)
        countdownInterval = null
    }
    if (pollingInterval) {
        clearInterval(pollingInterval)
        pollingInterval = null
    }
    if (autoCloseInterval) {
        clearInterval(autoCloseInterval)
        autoCloseInterval = null
    }
}

// 重置組件
const reset = () => {
    clearTimers()
    qrCode.value = ''
    deepLink.value = ''
    transactionId.value = ''
    remainingSeconds.value = 0
    success.value = false
    autoCloseCountdown.value = 5
}

// Expose methods
defineExpose({
    generate,
    regenerate,
    reset
})

// 使用預先產生的資料
const usePreGeneratedData = (data) => {
    qrCode.value = data.qrCode
    deepLink.value = data.deepLink || null
    transactionId.value = data.transactionId

    remainingSeconds.value = props.timeout
    startCountdown()
    startPolling()

    emit('generated', { transactionId: transactionId.value, data })
}

// 組件銷毀時清除計時器
onBeforeUnmount(() => {
    clearTimers()
})

// Auto generate on mount if enabled
if (props.autoGenerate) {
    // 如果有預先產生的資料，直接使用
    if (props.preGeneratedData) {
        usePreGeneratedData(props.preGeneratedData)
    } else {
        generate()
    }
}
</script>

<style scoped>
.vc-qr-scanner {
    width: 100%;
}

.qr-code-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.qr-code-image {
    max-width: 300px;
    width: 100%;
    display: block;
}

.countdown-timer {
    font-size: 36px;
    font-weight: bold;
    color: #667eea;
    margin-bottom: 8px;
}

.countdown-timer.warning {
    color: #ff9800;
}

.countdown-timer.danger {
    color: #f44336;
    animation: pulse 1s infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.gap-3 {
    gap: 12px;
}

ol {
    padding-left: 20px;
}

ol li {
    margin: 4px 0;
}
</style>
