<template>
    <v-container fluid class="airport-pos-page">
        <!-- 返回首頁按鈕 -->
        <v-btn
            icon="mdi-arrow-left"
            variant="text"
            class="back-button"
            @click="goHome"
        ></v-btn>

        <v-row justify="center" class="py-6">
            <v-col cols="12" md="10" lg="8">
                <!-- 商店標題 -->
                <div class="store-header text-center mb-6">
                    <v-icon size="80" color="primary">mdi-store</v-icon>
                    <h1 class="text-h3 font-weight-bold mt-4">天際免稅店</h1>
                    <p class="text-h6 text-medium-emphasis">桃園國際機場第一航廈</p>
                    <v-chip color="primary" variant="outlined" class="mt-2">
                        <v-icon start>mdi-airplane</v-icon>
                        臺灣航空特約商店
                    </v-chip>
                </div>

                <v-row>
                    <!-- 左側：商品清單 -->
                    <v-col cols="12" md="7">
                        <v-card elevation="4" rounded="lg">
                            <v-card-title class="bg-primary text-white d-flex align-center">
                                <v-icon start>mdi-cart</v-icon>
                                購物清單
                                <v-spacer></v-spacer>
                                <v-btn
                                    size="small"
                                    variant="text"
                                    color="white"
                                    prepend-icon="mdi-refresh"
                                    @click="generateProducts"
                                >
                                    重新生成
                                </v-btn>
                            </v-card-title>

                            <v-card-text class="pa-4">
                                <v-list>
                                    <v-list-item
                                        v-for="(item, index) in cartItems"
                                        :key="index"
                                        class="product-item"
                                    >
                                        <template v-slot:prepend>
                                            <v-avatar :color="item.color" size="48">
                                                <v-icon color="white">{{ item.icon }}</v-icon>
                                            </v-avatar>
                                        </template>

                                        <v-list-item-title class="font-weight-medium">
                                            {{ item.name }}
                                        </v-list-item-title>
                                        <v-list-item-subtitle>
                                            {{ item.description }}
                                        </v-list-item-subtitle>

                                        <template v-slot:append>
                                            <div class="text-right">
                                                <div class="text-h6 font-weight-bold">
                                                    ${{ item.price.toLocaleString() }}
                                                </div>
                                                <div class="text-caption text-medium-emphasis">
                                                    x{{ item.quantity }}
                                                </div>
                                            </div>
                                        </template>
                                    </v-list-item>
                                </v-list>

                                <v-divider class="my-4"></v-divider>

                                <!-- 小計 -->
                                <div class="d-flex justify-space-between align-center mb-2">
                                    <span class="text-h6">小計</span>
                                    <span class="text-h6 font-weight-bold">
                                        ${{ subtotal.toLocaleString() }}
                                    </span>
                                </div>

                                <!-- 折扣 -->
                                <div
                                    v-if="discountInfo && discountInfo.discount > 0"
                                    class="d-flex justify-space-between align-center mb-2"
                                >
                                    <span class="text-subtitle-1 text-success">
                                        <v-icon color="success" size="small">mdi-tag</v-icon>
                                        {{ discountInfo.discountDescription }} (-{{ discountInfo.discount }}%)
                                    </span>
                                    <span class="text-subtitle-1 text-success font-weight-bold">
                                        -${{ discountAmount.toLocaleString() }}
                                    </span>
                                </div>

                                <v-divider class="my-3"></v-divider>

                                <!-- 總計 -->
                                <div class="d-flex justify-space-between align-center">
                                    <span class="text-h5 font-weight-bold">總計</span>
                                    <span class="text-h4 font-weight-bold text-primary">
                                        ${{ finalTotal.toLocaleString() }}
                                    </span>
                                </div>

                                <!-- 結帳按鈕 -->
                                <v-btn
                                    block
                                    size="x-large"
                                    color="success"
                                    variant="elevated"
                                    class="mt-6"
                                    prepend-icon="mdi-cash-register"
                                    @click="checkout"
                                    :disabled="cartItems.length === 0"
                                >
                                    結帳
                                </v-btn>
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <!-- 右側：特約優惠驗證 -->
                    <v-col cols="12" md="5">
                        <v-card elevation="4" rounded="lg" class="sticky-card">
                            <v-card-title class="bg-secondary text-white d-flex align-center">
                                <v-icon start>mdi-account-check</v-icon>
                                特約優惠身分驗證
                            </v-card-title>

                            <v-card-text class="pa-4">
                                <v-alert
                                    v-if="!discountInfo"
                                    type="info"
                                    variant="tonal"
                                    class="mb-4"
                                >
                                    <v-alert-title>特約優惠方案</v-alert-title>
                                    <div class="mt-2">
                                        <p class="mb-2"><strong>臺灣航空特約優惠：</strong></p>
                                        <ul>
                                            <li>空服員：享 15% 折扣</li>
                                            <li>地勤人員：享 10% 折扣</li>
                                        </ul>
                                    </div>
                                </v-alert>

                                <!-- 已驗證優惠資格 -->
                                <v-alert
                                    v-if="discountInfo"
                                    type="success"
                                    variant="tonal"
                                    class="mb-4"
                                >
                                    <v-alert-title>
                                        驗證成功
                                    </v-alert-title>
                                    <div class="mt-2">
                                        <p><strong>公司：</strong>{{ discountInfo.companyName }}</p>
                                        <p><strong>職位：</strong>{{ discountInfo.position }}</p>
                                        <p v-if="discountInfo.discount > 0" class="text-success font-weight-bold mt-2">
                                            <v-icon color="success">mdi-tag-heart</v-icon>
                                            可享 {{ discountInfo.discount }}% 優惠折扣
                                        </p>
                                        <p v-else class="text-medium-emphasis mt-2">
                                            感謝您的支持，目前無專屬優惠
                                        </p>
                                    </div>
                                    <v-btn
                                        block
                                        variant="outlined"
                                        color="secondary"
                                        class="mt-3"
                                        prepend-icon="mdi-refresh"
                                        @click="resetVerification"
                                    >
                                        重新驗證
                                    </v-btn>
                                </v-alert>

                                <!-- 驗證按鈕 -->
                                <v-btn
                                    v-if="!discountInfo"
                                    block
                                    size="large"
                                    color="primary"
                                    variant="elevated"
                                    prepend-icon="mdi-qrcode-scan"
                                    @click="openVerificationDialog"
                                >
                                    驗證特約優惠
                                </v-btn>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>

        <!-- VP 驗證對話框 -->
        <v-dialog v-model="verificationDialog" max-width="600" persistent>
            <v-card>
                <v-card-title class="bg-primary text-white d-flex align-center">
                    <v-icon start>mdi-qrcode-scan</v-icon>
                    特約優惠身分驗證
                    <v-spacer></v-spacer>
                    <v-btn
                        icon="mdi-close"
                        variant="text"
                        color="white"
                        @click="closeVerificationDialog"
                    ></v-btn>
                </v-card-title>
                <v-card-text class="pa-6">
                    <VPQRCodeScanner
                        ref="vpScanner"
                        vpRef="00000000_vp_employee_identity_verification"
                        successMessage="已成功驗證特約優惠資格"
                        :autoStart="false"
                        @success="handleVPSuccess"
                        @error="handleVPError"
                    />
                </v-card-text>
            </v-card>
        </v-dialog>

        <!-- 結帳成功對話框 -->
        <v-dialog v-model="checkoutDialog" max-width="500">
            <v-card>
                <v-card-title class="bg-success text-white text-center py-6">
                    <v-icon size="60" color="white" class="mb-2">mdi-check-circle</v-icon>
                    <div class="text-h5">結帳成功</div>
                </v-card-title>
                <v-card-text class="text-center pa-6">
                    <p class="text-h6 mb-4">感謝您的購買！</p>
                    <p class="text-h4 font-weight-bold text-primary mb-2">
                        總金額：${{ finalTotal.toLocaleString() }}
                    </p>
                    <p v-if="discountInfo && discountInfo.discount > 0" class="text-success">
                        已為您節省 ${{ discountAmount.toLocaleString() }}
                    </p>
                </v-card-text>
                <v-card-actions class="justify-center pb-6">
                    <v-btn
                        color="primary"
                        variant="elevated"
                        size="large"
                        @click="closeCheckout"
                    >
                        完成
                    </v-btn>
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

// 加密安全的隨機數工具函數
// 使用 crypto.getRandomValues 取代 Math.random 以確保密碼學安全
const secureRandom = () => {
    const array = new Uint32Array(1)
    crypto.getRandomValues(array)
    return array[0] / (0xFFFFFFFF + 1)
}

const secureRandomInt = (min, max) => {
    return Math.floor(secureRandom() * (max - min + 1)) + min
}

// 加密安全的陣列洗牌 (Fisher-Yates shuffle)
const secureShuffleArray = (array) => {
    const result = [...array]
    for (let i = result.length - 1; i > 0; i--) {
        const j = secureRandomInt(0, i)
        ;[result[i], result[j]] = [result[j], result[i]]
    }
    return result
}

// 商品清單
const cartItems = ref([])

// VP 驗證相關
const vpScanner = ref(null)
const verificationDialog = ref(false)
const discountInfo = ref(null)

// UI 狀態
const checkoutDialog = ref(false)
const errorSnackbar = ref(false)
const errorMessage = ref('')

// 機場商店商品模板
const productTemplates = [
    { name: '精品香水', description: 'Chanel N°5 經典香水 50ml', icon: 'mdi-spray', color: 'pink' },
    { name: '巧克力禮盒', description: 'Godiva 經典巧克力禮盒', icon: 'mdi-candy', color: 'brown' },
    { name: '威士忌', description: 'Johnnie Walker Blue Label 750ml', icon: 'mdi-glass-cocktail', color: 'amber' },
    { name: '面膜組合', description: '日本進口保濕面膜 10片裝', icon: 'mdi-face-woman', color: 'purple' },
    { name: '太陽眼鏡', description: 'Ray-Ban 飛行員款太陽眼鏡', icon: 'mdi-sunglasses', color: 'grey' },
    { name: '香菸', description: '萬寶路香菸 1條', icon: 'mdi-smoking', color: 'red' },
    { name: '洋酒', description: 'Hennessy XO 干邑白蘭地 700ml', icon: 'mdi-bottle-wine', color: 'deep-orange' },
    { name: '化妝品組', description: 'Estée Lauder 經典保養組', icon: 'mdi-lipstick', color: 'deep-purple' },
    { name: '茶葉禮盒', description: '阿里山高山茶禮盒 300g', icon: 'mdi-tea', color: 'green' },
    { name: '鳳梨酥', description: '微熱山丘鳳梨酥禮盒 20入', icon: 'mdi-food', color: 'yellow-darken-2' },
]

// 隨機生成商品
const generateProducts = () => {
    const numItems = secureRandomInt(2, 4)
    const shuffled = secureShuffleArray(productTemplates)

    cartItems.value = shuffled.slice(0, numItems).map(template => ({
        ...template,
        price: secureRandomInt(500, 4500),
        quantity: secureRandomInt(1, 2)
    }))
}

// 計算小計
const subtotal = computed(() => {
    return cartItems.value.reduce((sum, item) => sum + (item.price * item.quantity), 0)
})

// 計算折扣金額
const discountAmount = computed(() => {
    if (!discountInfo.value || discountInfo.value.discount === 0) {
        return 0
    }
    return Math.floor(subtotal.value * discountInfo.value.discount / 100)
})

// 計算最終總額
const finalTotal = computed(() => {
    return subtotal.value - discountAmount.value
})

// 打開驗證對話框
const openVerificationDialog = () => {
    verificationDialog.value = true
    // 等待 DOM 更新後再啟動掃描
    setTimeout(() => {
        if (vpScanner.value) {
            vpScanner.value.start()
        }
    }, 100)
}

// 關閉驗證對話框
const closeVerificationDialog = () => {
    verificationDialog.value = false
    if (vpScanner.value) {
        vpScanner.value.reset()
    }
}

// VP 驗證成功
const handleVPSuccess = async (result) => {
    // 立即關閉對話框，避免顯示成功訊息
    verificationDialog.value = false

    try {
        // 呼叫後端 API 計算折扣
        const response = await fetch('/api/airport-pos/calculate-discount', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                transactionId: result.transactionId
            })
        })

        const data = await response.json()

        if (!response.ok) {
            throw new Error(data.message || '計算折扣失敗')
        }

        discountInfo.value = data
    } catch (error) {
        errorMessage.value = error.message
        errorSnackbar.value = true

        // 重置驗證狀態
        resetVerification()
    }
}

// VP 驗證失敗
const handleVPError = (error) => {
    errorMessage.value = error
    errorSnackbar.value = true
}

// 重置驗證
const resetVerification = () => {
    verificationDialog.value = false
    discountInfo.value = null
    if (vpScanner.value) {
        vpScanner.value.reset()
    }
}

// 結帳
const checkout = () => {
    checkoutDialog.value = true
}

// 關閉結帳對話框
const closeCheckout = () => {
    checkoutDialog.value = false
    // 重置所有狀態
    generateProducts()
    resetVerification()
}

// 返回首頁
const goHome = () => {
    router.push({ name: 'Home' })
}

// 初始化
onMounted(() => {
    generateProducts()
})
</script>

<style scoped>
.airport-pos-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    position: relative;
}

.back-button {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 10;
}

.store-header {
    background: white;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.product-item {
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    padding: 12px 0;
}

.product-item:last-child {
    border-bottom: none;
}

.sticky-card {
    position: sticky;
    top: 20px;
}

@media (max-width: 960px) {
    .sticky-card {
        position: static;
    }
}
</style>
