<template>
    <v-app>
        <!-- 頂部導航欄 -->
        <v-app-bar color="primary" prominent>
            <template v-slot:prepend>
                <v-icon size="40" class="ml-4">mdi-airplane</v-icon>
            </template>

            <v-app-bar-title class="text-h5 font-weight-bold">
                CrediBiz - 臺灣航空
            </v-app-bar-title>

            <template v-slot:append>
                <v-btn
                    variant="text"
                    prepend-icon="mdi-logout"
                    @click="logout"
                >
                    登出
                </v-btn>
            </template>
        </v-app-bar>

        <!-- 主要內容 -->
        <v-main>
            <v-container fluid class="dashboard-page">
                <!-- 歡迎標題 -->
                <v-row>
                    <v-col cols="12">
                        <div class="text-h4 mb-2">
                            歡迎回來，{{ employeeName }}！
                        </div>
                        <div class="text-subtitle-1 text-medium-emphasis">
                            員工編號：{{ employeeId }}
                        </div>
                    </v-col>
                </v-row>

                <!-- 統計卡片 -->
                <v-row class="mt-6">
                    <v-col cols="12" md="3">
                        <v-card class="stat-card">
                            <v-card-text>
                                <div class="d-flex align-center">
                                    <v-icon size="48" color="primary" class="mr-4">
                                        mdi-account-check
                                    </v-icon>
                                    <div>
                                        <div class="text-h6">員工狀態</div>
                                        <div class="text-h4 font-weight-bold text-primary">在職</div>
                                    </div>
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <v-col cols="12" md="3">
                        <v-card class="stat-card">
                            <v-card-text>
                                <div class="d-flex align-center">
                                    <v-icon size="48" color="success" class="mr-4">
                                        mdi-shield-check
                                    </v-icon>
                                    <div>
                                        <div class="text-h6">憑證狀態</div>
                                        <div class="text-h4 font-weight-bold text-success">已驗證</div>
                                    </div>
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <v-col cols="12" md="3">
                        <v-card class="stat-card">
                            <v-card-text>
                                <div class="d-flex align-center">
                                    <v-icon size="48" color="info" class="mr-4">
                                        mdi-briefcase
                                    </v-icon>
                                    <div>
                                        <div class="text-h6">部門</div>
                                        <div class="text-h6 font-weight-bold text-info">{{ employeeDepartment }}</div>
                                    </div>
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <v-col cols="12" md="3">
                        <v-card class="stat-card">
                            <v-card-text>
                                <div class="d-flex align-center">
                                    <v-icon size="48" color="warning" class="mr-4">
                                        mdi-calendar-clock
                                    </v-icon>
                                    <div>
                                        <div class="text-h6">在職天數</div>
                                        <div class="text-h4 font-weight-bold text-warning">{{ daysEmployed }}</div>
                                    </div>
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>

                <!-- 業務功能區 -->
                <v-row class="mt-6">
                    <v-col cols="12">
                        <v-card class="feature-card" elevation="4" rounded="lg">
                            <v-card-title class="text-h5 bg-gradient-primary pa-4">
                                <v-icon class="mr-2">mdi-briefcase</v-icon>
                                業務系統功能
                            </v-card-title>
                            <v-card-text class="pa-6">
                                <v-row>
                                    <!-- 病假申請功能 -->
                                    <v-col cols="12" sm="6" md="4">
                                        <v-card
                                            class="function-card"
                                            elevation="2"
                                            rounded="lg"
                                            hover
                                            @click="goToMedicalLeave"
                                        >
                                            <v-card-text class="text-center pa-6">
                                                <v-icon size="64" color="error" class="mb-4">
                                                    mdi-hospital-box
                                                </v-icon>
                                                <div class="text-h6 mb-2">病假申請</div>
                                                <div class="text-body-2 text-medium-emphasis">
                                                    使用醫療診斷證明申請病假
                                                </div>
                                            </v-card-text>
                                        </v-card>
                                    </v-col>

                                    <!-- 停車證申請功能 -->
                                    <v-col cols="12" sm="6" md="4">
                                        <v-card
                                            class="function-card"
                                            elevation="2"
                                            rounded="lg"
                                            hover
                                            @click="goToParkingPermit"
                                        >
                                            <v-card-text class="text-center pa-6">
                                                <v-icon size="64" color="indigo" class="mb-4">
                                                    mdi-car
                                                </v-icon>
                                                <div class="text-h6 mb-2">停車證申請</div>
                                                <div class="text-body-2 text-medium-emphasis">
                                                    申請臺灣航空地下停車場停車證
                                                </div>
                                            </v-card-text>
                                        </v-card>
                                    </v-col>
                                </v-row>

                                <v-alert
                                    type="info"
                                    variant="tonal"
                                    class="mt-6"
                                >
                                    <v-alert-title>業務功能區</v-alert-title>
                                    <div>
                                        這裡將展示企業內部各種業務操作流程，每個功能都會整合數位憑證驗證機制，
                                        確保操作的安全性與可追溯性。
                                    </div>
                                </v-alert>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>

                <!-- 個人資訊與憑證資訊 -->
                <v-row class="mt-6">
                    <v-col cols="12" md="6">
                        <v-card class="feature-card" elevation="4" rounded="lg">
                            <v-card-title class="text-h6 bg-gradient-info pa-4">
                                <v-icon class="mr-2">mdi-account</v-icon>
                                個人資訊
                            </v-card-title>
                            <v-card-text class="pa-4">
                                <v-list lines="two" bg-color="transparent" density="compact">
                                    <v-list-item>
                                        <v-list-item-title class="text-caption text-medium-emphasis">
                                            員工編號
                                        </v-list-item-title>
                                        <v-list-item-subtitle class="text-body-1 font-weight-bold">
                                            {{ employeeId }}
                                        </v-list-item-subtitle>
                                    </v-list-item>

                                    <v-divider />

                                    <v-list-item>
                                        <v-list-item-title class="text-caption text-medium-emphasis">
                                            姓名
                                        </v-list-item-title>
                                        <v-list-item-subtitle class="text-body-1 font-weight-bold">
                                            {{ employeeName }}
                                        </v-list-item-subtitle>
                                    </v-list-item>

                                    <v-divider />

                                    <v-list-item>
                                        <v-list-item-title class="text-caption text-medium-emphasis">
                                            公司
                                        </v-list-item-title>
                                        <v-list-item-subtitle class="text-body-1 font-weight-bold">
                                            臺灣航空
                                        </v-list-item-subtitle>
                                    </v-list-item>

                                    <v-divider />

                                    <v-list-item>
                                        <v-list-item-title class="text-caption text-medium-emphasis">
                                            最後登入時間
                                        </v-list-item-title>
                                        <v-list-item-subtitle class="text-body-2">
                                            {{ lastLoginAt || '首次登入' }}
                                        </v-list-item-subtitle>
                                    </v-list-item>
                                </v-list>
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <v-col cols="12" md="6">
                        <v-card class="feature-card" elevation="4" rounded="lg">
                            <v-card-title class="text-h6 bg-gradient-success pa-4">
                                <v-icon class="mr-2">mdi-shield-check</v-icon>
                                數位憑證狀態
                            </v-card-title>
                            <v-card-text class="pa-4">
                                <v-alert
                                    type="success"
                                    variant="tonal"
                                    class="mb-3"
                                >
                                    <v-alert-title>憑證已驗證</v-alert-title>
                                </v-alert>

                                <div class="credential-info">
                                    <div class="credential-item">
                                        <v-icon color="success" size="small" class="mr-2">mdi-check-circle</v-icon>
                                        <span class="text-body-2">員工證明 VC</span>
                                    </div>
                                    <div class="credential-item mt-2">
                                        <v-icon color="info" size="small" class="mr-2">mdi-shield-account</v-icon>
                                        <span class="text-body-2">使用 TW-DIW 安全儲存</span>
                                    </div>
                                    <div class="credential-item mt-2">
                                        <v-icon color="primary" size="small" class="mr-2">mdi-lock-check</v-icon>
                                        <span class="text-body-2">已通過區塊鏈驗證</span>
                                    </div>
                                    <div v-if="vcExpiryDate" class="credential-item mt-2">
                                        <v-icon color="warning" size="small" class="mr-2">mdi-calendar-clock</v-icon>
                                        <span class="text-body-2">到期日：{{ vcExpiryDate }}</span>
                                    </div>
                                </div>

                                <v-divider class="my-4" />

                                <v-btn
                                    color="warning"
                                    variant="outlined"
                                    block
                                    prepend-icon="mdi-card-refresh"
                                    @click="showReissueDialog = true"
                                >
                                    換發員工憑證
                                </v-btn>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>

                <!-- 換發憑證對話框 -->
                <v-dialog v-model="showReissueDialog" max-width="800" persistent>
                    <v-card>
                        <v-card-title class="text-h5 pa-4 d-flex align-center justify-space-between">
                            <span>換發員工數位憑證</span>
                            <v-btn
                                icon="mdi-close"
                                variant="text"
                                size="small"
                                @click="closeReissueDialog"
                            />
                        </v-card-title>

                        <v-card-text class="pa-6">
                            <!-- 步驟 1: 說明 -->
                            <div v-if="reissueStep === 1">
                                <v-alert type="warning" variant="tonal" prominent class="mb-4">
                                    <v-alert-title>重要提醒</v-alert-title>
                                    <div>
                                        換發憑證適用於以下情況：
                                        <ul class="mt-2">
                                            <li>更換新手機或裝置</li>
                                            <li>重新安裝數位憑證皮夾 App</li>
                                            <li>憑證遺失或無法使用</li>
                                        </ul>
                                    </div>
                                </v-alert>

                                <v-alert type="info" variant="tonal" class="mb-4">
                                    <v-alert-title>換發流程說明</v-alert-title>
                                    <ol class="mt-2">
                                        <li>系統會產生新的員工憑證 QR Code</li>
                                        <li>使用數位憑證皮夾掃描 QR Code 領取新憑證</li>
                                        <li>確認領取成功後，系統會自動撤銷（revoke）舊憑證</li>
                                        <li>完成後需要重新登入系統</li>
                                    </ol>
                                </v-alert>

                                <v-alert type="error" variant="tonal" border="start">
                                    <v-alert-title>注意事項</v-alert-title>
                                    <div>
                                        <strong>舊憑證撤銷後將無法復原</strong>，請確保在新裝置上成功領取新憑證後再進行換發。
                                    </div>
                                </v-alert>

                                <div class="d-flex justify-end gap-2 mt-6">
                                    <v-btn
                                        variant="text"
                                        @click="closeReissueDialog"
                                    >
                                        取消
                                    </v-btn>
                                    <v-btn
                                        color="primary"
                                        @click="startReissue"
                                        :loading="reissueLoading"
                                    >
                                        開始換發
                                    </v-btn>
                                </div>
                            </div>

                            <!-- 步驟 2: 掃描 QR Code -->
                            <div v-if="reissueStep === 2">
                                <VCQRCodeScanner
                                    ref="reissueScanner"
                                    status-endpoint="/api/test/vc/status/{transactionId}"
                                    button-text=""
                                    success-message="新憑證領取成功！正在撤銷舊憑證並更新系統資料..."
                                    :auto-generate="true"
                                    :pre-generated-data="reissuePreGeneratedData"
                                    @success="handleReissueSuccess"
                                    @error="handleReissueError"
                                />

                                <v-alert type="info" variant="tonal" class="mt-4">
                                    <v-alert-title>操作步驟</v-alert-title>
                                    <ol class="mt-2">
                                        <li>打開數位憑證皮夾 App</li>
                                        <li>選擇「掃描」功能</li>
                                        <li>掃描上方 QR Code</li>
                                        <li>確認憑證資訊無誤後領取</li>
                                    </ol>
                                </v-alert>
                            </div>

                            <!-- 步驟 3: 處理中 -->
                            <div v-if="reissueStep === 3" class="text-center py-8">
                                <v-progress-circular
                                    indeterminate
                                    color="primary"
                                    size="64"
                                />
                                <p class="mt-4 text-h6">正在撤銷舊憑證並更新系統資料...</p>
                                <p class="text-caption text-medium-emphasis">請稍候，不要關閉此視窗</p>
                            </div>

                            <!-- 步驟 4: 完成 -->
                            <div v-if="reissueStep === 4" class="text-center py-8">
                                <v-icon size="80" color="success">mdi-check-circle</v-icon>
                                <h3 class="text-h5 mt-4 mb-2">憑證換發完成</h3>
                                <p class="text-body-1 text-medium-emphasis mb-6">
                                    舊憑證已撤銷，新憑證已生效。<br>
                                    系統將在 3 秒後自動登出，請使用新憑證重新登入。
                                </p>
                            </div>

                            <!-- 錯誤訊息 -->
                            <v-alert
                                v-if="reissueError"
                                type="error"
                                variant="tonal"
                                closable
                                @click:close="reissueError = ''"
                                class="mt-4"
                            >
                                {{ reissueError }}
                            </v-alert>
                        </v-card-text>
                    </v-card>
                </v-dialog>

                <!-- 系統資訊 -->
                <v-row class="mt-6">
                    <v-col cols="12">
                        <v-card class="info-card" elevation="1">
                            <v-card-text>
                                <v-alert
                                    type="info"
                                    variant="tonal"
                                    border="start"
                                >
                                    <v-alert-title>系統說明</v-alert-title>
                                    <div>
                                        此系統為「數位憑證場景創新賽」參賽作品，展示中小企業如何整合 TW-DIW（Taiwan Digital Identity Wallet）
                                        數位憑證技術於員工招募、入職及日常管理流程。
                                    </div>
                                    <ul class="mt-2">
                                        <li>✓ 應徵時使用政府發行的 VC（身分證、學位證書、英檢證書）進行身份驗證</li>
                                        <li>✓ 錄取後領取公司發行的員工證明 VC</li>
                                        <li>✓ 使用員工證明 VC 登入內部系統（無需密碼）</li>
                                        <li>✓ 所有憑證均經過區塊鏈驗證，確保真實性</li>
                                    </ul>
                                </v-alert>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import VCQRCodeScanner from '@/components/VCQRCodeScanner.vue'

const router = useRouter()

const employeeId = ref('')
const employeeName = ref('')
const employeeDepartment = ref('')
const employeePosition = ref('')
const employeeCompany = ref('')
const daysEmployed = ref(0)
const lastLoginAt = ref('')
const vcExpiryDate = ref('')

// 換發憑證相關
const showReissueDialog = ref(false)
const reissueStep = ref(1) // 1: 說明, 2: 掃描QR, 3: 處理中, 4: 完成
const reissueLoading = ref(false)
const reissueError = ref('')
const reissueApiEndpoint = ref('')
const reissueScanner = ref(null)
const reissueTransactionId = ref('')
const reissueOldCid = ref('')
const reissuePreGeneratedData = ref(null)

onMounted(async () => {
    // 檢查登入狀態
    const token = localStorage.getItem('auth_token')
    if (!token) {
        router.push({ name: 'Login' })
        return
    }

    // 向後端驗證 Token 是否有效並取得員工資訊
    try {
        const response = await fetch('/api/user', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        })

        if (!response.ok) {
            // Token 無效，清除 localStorage 並跳轉到登入頁
            localStorage.clear()
            router.push({ name: 'Login' })
            return
        }

        // 從後端取得員工資訊
        const data = await response.json()
        employeeId.value = data.employee_id || '000000'
        employeeName.value = data.name || '訪客'
        employeeDepartment.value = data.department || '未設定'
        employeePosition.value = data.position || '未設定'
        employeeCompany.value = data.company_name || '臺灣航空'

        // 設定最後登入時間
        if (data.last_login_at) {
            lastLoginAt.value = new Date(data.last_login_at).toLocaleString('zh-TW')
        }

        // 設定憑證到期日
        if (data.employee_vc_expiry_date) {
            vcExpiryDate.value = data.employee_vc_expiry_date
        }

    } catch (error) {
        // 網路錯誤或其他問題，清除並跳轉
        console.error('驗證 Token 失敗:', error)
        localStorage.clear()
        router.push({ name: 'Login' })
        return
    }

    // 計算在職天數（假設今天是第一天）
    daysEmployed.value = 1
})

const logout = async () => {
    const token = localStorage.getItem('auth_token')

    try {
        // 呼叫後端撤銷 token
        await fetch('/api/auth/logout', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        })
    } catch (error) {
        console.error('登出錯誤:', error)
    } finally {
        // 清除 localStorage
        localStorage.removeItem('auth_token')
        localStorage.removeItem('employee_id')
        localStorage.removeItem('employee_name')
        localStorage.removeItem('employee_department')
        localStorage.removeItem('employee_position')
        localStorage.removeItem('employee_company')

        // 跳轉到首頁
        router.push({ name: 'Home' })
    }
}

// 前往病假申請頁面
const goToMedicalLeave = () => {
    router.push({ name: 'MedicalLeave' })
}

// 前往停車證申請頁面
const goToParkingPermit = () => {
    router.push({ name: 'ParkingPermit' })
}

// 開始換發憑證
const startReissue = async () => {
    reissueLoading.value = true
    reissueError.value = ''

    try {
        const token = localStorage.getItem('auth_token')
        const response = await fetch('/api/employee-credentials/reissue', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        })

        const data = await response.json()

        if (!response.ok) {
            throw new Error(data.message || '發起換發失敗')
        }

        // 保存舊 CID 和交易 ID
        reissueOldCid.value = data.oldCid
        reissueTransactionId.value = data.transactionId

        // 保存預先產生的 QR Code 資料
        reissuePreGeneratedData.value = {
            qrCode: data.qrCode,
            deepLink: data.deepLink,
            transactionId: data.transactionId
        }

        // 進入步驟 2
        reissueStep.value = 2
    } catch (error) {
        reissueError.value = error.message
    } finally {
        reissueLoading.value = false
    }
}

// 處理新憑證領取成功
const handleReissueSuccess = async ({ cid, transactionId }) => {
    reissueStep.value = 3
    reissueError.value = ''

    try {
        const token = localStorage.getItem('auth_token')
        const response = await fetch('/api/employee-credentials/confirm-reissue', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                new_vc_transaction_id: transactionId,
                new_vc_cid: cid,
                old_vc_cid: reissueOldCid.value
            })
        })

        const data = await response.json()

        if (!response.ok) {
            throw new Error(data.message || '確認換發失敗')
        }

        // 換發成功
        reissueStep.value = 4

        // 3 秒後登出
        setTimeout(() => {
            logout()
        }, 3000)
    } catch (error) {
        reissueError.value = error.message
        reissueStep.value = 2
    }
}

// 處理換發錯誤
const handleReissueError = (error) => {
    reissueError.value = error
}

// 關閉換發對話框
const closeReissueDialog = () => {
    if (reissueStep.value === 2) {
        reissueScanner.value?.reset()
    }
    showReissueDialog.value = false
    reissueStep.value = 1
    reissueError.value = ''
    reissueTransactionId.value = ''
    reissueOldCid.value = ''
}
</script>

<style scoped>
.dashboard-page {
    padding: 24px;
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    min-height: calc(100vh - 64px);
}

.stat-card {
    height: 100%;
    transition: transform 0.2s, box-shadow 0.2s;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
}

.feature-card {
    height: 100%;
}

.function-card {
    height: 100%;
    transition: transform 0.2s, box-shadow 0.2s;
    min-height: 180px;
}

.function-card:not([disabled]):hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #4fc3f7 0%, #2196f3 100%);
    color: white;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #66bb6a 0%, #43a047 100%);
    color: white;
}

.credential-info {
    padding: 8px;
}

.credential-item {
    display: flex;
    align-items: center;
}

.info-card {
    background: white;
}

ul {
    margin-top: 8px;
    padding-left: 20px;
}

ul li {
    margin: 4px 0;
}

/* 手機響應式設計 */
@media (max-width: 960px) {
    .dashboard-page {
        padding: 16px;
    }

    .stat-card {
        margin-bottom: 16px;
    }
}

@media (max-width: 600px) {
    .dashboard-page {
        padding: 12px;
    }

    :deep(.v-app-bar-title) {
        font-size: 1.1rem !important;
    }

    .text-h4 {
        font-size: 1.5rem !important;
    }

    .function-card {
        min-height: 160px;
    }

    :deep(.v-card-title) {
        font-size: 1.1rem !important;
        padding: 12px !important;
    }
}
</style>
