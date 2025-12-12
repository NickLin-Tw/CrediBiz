<template>
    <div class="vp-qr-scanner">
        <!-- 使用說明 -->
        <v-alert
            v-if="!verified"
            type="info"
            variant="tonal"
            class="mb-4"
        >
            <v-alert-title>如何驗證？</v-alert-title>
            <ol class="mt-2">
                <li>打開數位憑證皮夾 App，選擇「掃描」</li>
                <li>掃描下方 QR Code，並確認授權內容後送出</li>
            </ol>
        </v-alert>

        <!-- 倒數計時 -->
        <div v-if="countdown > 0 && !verified" class="text-center mb-4">
            <div
                :class="[
                    'countdown-timer',
                    { 'warning': countdown <= 60 && countdown > 30 },
                    { 'danger': countdown <= 30 }
                ]"
            >
                ⏱️ {{ formatTime(countdown) }}
            </div>
            <p class="text-caption text-medium-emphasis">請在時間內完成掃描</p>
        </div>

        <!-- QR Code -->
        <div v-if="qrCode && countdown > 0 && !verified">
            <div class="qr-code-container">
                <img :src="qrCode" alt="VP QR Code" class="qr-code-image" />
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
                    color="primary"
                    variant="outlined"
                    @click="regenerate"
                    :loading="loading"
                    prepend-icon="mdi-refresh"
                >
                    重新產生 QR Code
                </v-btn>
            </div>
        </div>

        <!-- 逾時訊息 -->
        <div v-if="countdown <= 0 && !verified" class="text-center">
            <v-icon size="80" color="error">mdi-clock-alert-outline</v-icon>
            <h3 class="text-h6 mt-4 mb-2">驗證逾時</h3>
            <p class="text-body-2 text-medium-emphasis mb-4">
                請重新產生 QR Code
            </p>
            <v-btn
                color="primary"
                variant="elevated"
                @click="regenerate"
                :loading="loading"
            >
                重新產生 QR Code
            </v-btn>
        </div>

        <!-- 載入中 -->
        <div v-if="loading && !qrCode" class="text-center py-8">
            <v-progress-circular
                indeterminate
                color="primary"
                size="64"
            ></v-progress-circular>
            <p class="mt-4">正在產生 QR Code...</p>
        </div>

        <!-- 驗證成功訊息 -->
        <v-alert
            v-if="verified"
            type="success"
            variant="tonal"
            prominent
        >
            <v-alert-title>✓ 憑證驗證成功</v-alert-title>
            <div>{{ successMessage }}</div>
        </v-alert>
    </div>
</template>

<script setup>
import { ref, onBeforeUnmount, onMounted } from 'vue'

const props = defineProps({
    // VP reference code (e.g., "00000000_vp_recruitment")
    vpRef: {
        type: String,
        required: false,
        default: ''
    },
    // API endpoint for generating VP QR code
    apiEndpoint: {
        type: String,
        default: '/api/test/vp/generate'
    },
    // API endpoint for checking VP status
    statusEndpoint: {
        type: String,
        default: '/api/test/vp/result'
    },
    // Success message
    successMessage: {
        type: String,
        default: '已成功驗證您的數位憑證'
    },
    // Auto start on mount
    autoStart: {
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
    },
    // Show in dialog
    dialog: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['success', 'error', 'generated', 'cancel'])

const loading = ref(false)
const qrCode = ref('')
const deepLink = ref('')
const transactionId = ref('')
const countdown = ref(0)
const verified = ref(false)

let countdownInterval = null
let pollingInterval = null

// 產生 UUID (使用加密安全的隨機數生成器)
const generateUUID = () => {
    // 使用 crypto.getRandomValues 取代 Math.random 以確保密碼學安全
    const randomValues = new Uint8Array(16)
    crypto.getRandomValues(randomValues)

    // 設定 version (4) 和 variant (RFC 4122)
    randomValues[6] = (randomValues[6] & 0x0f) | 0x40 // version 4
    randomValues[8] = (randomValues[8] & 0x3f) | 0x80 // variant RFC 4122

    const hex = Array.from(randomValues).map(b => b.toString(16).padStart(2, '0')).join('')
    return `${hex.slice(0, 8)}-${hex.slice(8, 12)}-${hex.slice(12, 16)}-${hex.slice(16, 20)}-${hex.slice(20, 32)}`
}

// 開始驗證流程
const start = async () => {
    loading.value = true
    verified.value = false

    try {
        // 產生唯一的 transaction ID
        transactionId.value = generateUUID()

        // 準備請求體
        const requestBody = {
            transactionId: transactionId.value
        }

        // 如果有 vpRef，添加到請求體中
        if (props.vpRef) {
            requestBody.ref = props.vpRef
        }

        // 獲取 auth token（如果需要）
        const token = localStorage.getItem('auth_token')
        const headers = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        }

        if (token) {
            headers['Authorization'] = `Bearer ${token}`
        }

        // 呼叫 VP 驗證 API（使用傳入的 endpoint 或預設值）
        const response = await fetch(props.apiEndpoint, {
            method: 'POST',
            headers,
            body: JSON.stringify(requestBody)
        })

        const data = await response.json()

        if (!response.ok) {
            throw new Error(data.message || '產生 QR Code 失敗')
        }

        qrCode.value = data.qrCode || data.qr_code
        deepLink.value = data.authUri || data.deep_link || null

        // 開始倒數計時
        countdown.value = props.timeout
        startCountdown()

        // 開始輪詢驗證結果
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
    countdown.value = 0
    start()
}

// 開始倒數計時
const startCountdown = () => {
    clearInterval(countdownInterval)
    countdownInterval = setInterval(() => {
        countdown.value--
        if (countdown.value <= 0) {
            clearInterval(countdownInterval)
            if (pollingInterval) clearInterval(pollingInterval)
        }
    }, 1000)
}

// 開始輪詢
const startPolling = () => {
    clearInterval(pollingInterval)
    pollingInterval = setInterval(async () => {
        try {
            // 獲取 auth token（如果需要）
            const token = localStorage.getItem('auth_token')
            const headers = {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }

            if (token) {
                headers['Authorization'] = `Bearer ${token}`
            }

            const response = await fetch(props.statusEndpoint, {
                method: 'POST',
                headers,
                body: JSON.stringify({
                    transactionId: transactionId.value
                })
            })

            const data = await response.json()

            if (response.ok && data.verifyResult !== null) {
                clearTimers()
                handleVerifyResult(data)
            }
        } catch (error) {
            console.error('輪詢錯誤:', error)
        }
    }, props.pollingInterval)
}

// 處理驗證結果
const handleVerifyResult = (data) => {
    if (!data.verifyResult) {
        // 驗證失敗
        emit('error', data.resultDescription || '驗證失敗')
        reset()
        return
    }

    // 驗證成功
    verified.value = true
    emit('success', {
        transactionId: transactionId.value,
        vpData: data.data || [],
        fullResponse: data
    })
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
}

// 重置組件
const reset = () => {
    clearTimers()
    qrCode.value = ''
    deepLink.value = ''
    transactionId.value = ''
    countdown.value = 0
    verified.value = false
}

// 取消驗證
const cancel = () => {
    reset()
    emit('cancel')
}

// Expose methods
defineExpose({
    start,
    regenerate,
    reset,
    cancel,
    getTransactionId: () => transactionId.value,
    isVerified: () => verified.value
})

// 組件銷毀時清除計時器
onBeforeUnmount(() => {
    clearTimers()
})

// Auto start on mount if enabled
onMounted(() => {
    if (props.autoStart) {
        start()
    }
})
</script>

<style scoped>
.vp-qr-scanner {
    width: 100%;
}

.qr-code-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.qr-code-image {
    max-width: 300px;
    width: 100%;
    border: 4px solid white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
