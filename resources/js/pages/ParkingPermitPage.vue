<template>
    <v-container fluid class="parking-permit-page">
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
                    <v-card-title class="text-h4 bg-indigo pa-6">
                        <v-icon size="large" class="mr-3">mdi-car</v-icon>
                        停車證申請
                    </v-card-title>
                </v-card>

                <!-- 載入中 -->
                <v-card v-if="loading" class="text-center pa-10">
                    <v-progress-circular
                        indeterminate
                        color="indigo"
                        size="64"
                    ></v-progress-circular>
                    <p class="mt-4">載入中...</p>
                </v-card>

                <!-- 已有停車證 -->
                <v-card v-else-if="hasPermit" elevation="2">
                    <v-card-title class="bg-success">
                        <v-icon class="mr-2">mdi-check-circle</v-icon>
                        您已擁有停車證
                    </v-card-title>
                    <v-card-text class="pa-6">
                        <v-row>
                            <v-col cols="12" md="6">
                                <div class="text-subtitle-2 text-grey">停車證編號</div>
                                <div class="text-h6 mb-3">{{ permit.permit_id }}</div>

                                <div class="text-subtitle-2 text-grey">姓名</div>
                                <div class="text-body-1 mb-3">{{ permit.name }}</div>

                                <div class="text-subtitle-2 text-grey">停車類型</div>
                                <div class="text-body-1 mb-3">{{ permit.parking_type }}</div>

                                <div class="text-subtitle-2 text-grey">發行日期</div>
                                <div class="text-body-2 mb-3">{{ permit.issued_at }}</div>

                                <div class="text-subtitle-2 text-grey">到期日</div>
                                <div class="text-body-2">{{ permit.expiry_date }}</div>
                            </v-col>
                            <v-col cols="12" md="6">
                                <div class="text-subtitle-2 text-grey mb-3">登記車輛</div>
                                <v-list>
                                    <v-list-item
                                        v-for="vehicle in permit.vehicles"
                                        :key="vehicle.id"
                                        class="mb-2"
                                        border
                                        rounded
                                    >
                                        <template v-slot:prepend>
                                            <v-icon>mdi-car</v-icon>
                                        </template>
                                        <v-list-item-title>{{ vehicle.vehicle_plate_number }}</v-list-item-title>
                                        <v-list-item-subtitle>
                                            {{ vehicle.vehicle_type }} | {{ vehicle.brand_model }} | {{ vehicle.color }}
                                        </v-list-item-subtitle>
                                    </v-list-item>
                                </v-list>
                            </v-col>
                        </v-row>

                        <v-divider class="my-4"></v-divider>

                        <v-alert type="info" variant="tonal" class="mb-4">
                            每位員工只能申請一張停車證，但可以登記多台車輛。車輛資訊可隨時更新，停車證遺失時才需要換發。
                        </v-alert>

                        <div class="text-center d-flex gap-3 justify-center">
                            <v-btn
                                color="primary"
                                variant="elevated"
                                size="large"
                                prepend-icon="mdi-pencil"
                                @click="openEditVehicles"
                            >
                                編輯車輛資訊
                            </v-btn>
                            <v-btn
                                color="warning"
                                variant="outlined"
                                size="large"
                                prepend-icon="mdi-refresh"
                                @click="showReissueConfirm = true"
                            >
                                換發停車證
                            </v-btn>
                        </div>
                    </v-card-text>
                </v-card>

                <!-- 申請流程 -->
                <v-card v-else elevation="2">
                    <v-stepper v-model="currentStep" alt-labels>
                        <v-stepper-header>
                            <v-stepper-item
                                :complete="currentStep > 1"
                                :value="1"
                                color="indigo"
                            >
                                <template v-slot:icon>
                                    <v-icon>mdi-shield-check</v-icon>
                                </template>
                                <template v-slot:title>
                                    驗證員工證
                                </template>
                            </v-stepper-item>

                            <v-divider></v-divider>

                            <v-stepper-item
                                :complete="currentStep > 2"
                                :value="2"
                                color="indigo"
                            >
                                <template v-slot:icon>
                                    <v-icon>mdi-car-info</v-icon>
                                </template>
                                <template v-slot:title>
                                    填寫車輛資料
                                </template>
                            </v-stepper-item>

                            <v-divider></v-divider>

                            <v-stepper-item
                                :value="3"
                                color="indigo"
                            >
                                <template v-slot:icon>
                                    <v-icon>mdi-check-circle</v-icon>
                                </template>
                                <template v-slot:title>
                                    領取停車證
                                </template>
                            </v-stepper-item>
                        </v-stepper-header>

                        <v-stepper-window>
                            <!-- Step 1: 驗證員工證 -->
                            <v-stepper-window-item :value="1">
                                <v-card-text class="pa-8">
                                    <v-alert type="info" variant="tonal" prominent class="mb-6">
                                        <v-alert-title>申請流程說明</v-alert-title>
                                        <ol class="mt-2">
                                            <li>點擊「開始驗證」按鈕產生 QR Code</li>
                                            <li>使用數位憑證皮夾掃描 QR Code</li>
                                            <li>提交您的<strong>員工證</strong> VP</li>
                                            <li>系統自動驗證並進入下一步</li>
                                        </ol>
                                    </v-alert>

                                    <v-alert type="warning" variant="tonal" border="start" class="mb-6">
                                        <v-alert-title>審核標準與注意事項</v-alert-title>
                                        <ul class="mt-2">
                                            <li><strong>每位員工限申請一張停車證</strong>，但可登記多台車輛</li>
                                            <li>提交的員工證必須與登入者一致</li>
                                            <li>領取停車證時，必須使用與領取員工證相同的數位皮夾裝置</li>
                                            <li>若 Holder DID 不符，停車證將被自動撤銷</li>
                                            <li><strong>車輛資訊可隨時編輯更新</strong>，無需換發停車證 VC</li>
                                            <li>僅在停車證 VC 遺失時才需要申請換發</li>
                                        </ul>
                                    </v-alert>

                                    <div class="text-center">
                                        <v-icon size="120" color="indigo" class="mb-4">
                                            mdi-shield-check-outline
                                        </v-icon>
                                        <div class="text-h5 mb-6">準備好您的員工證</div>

                                        <v-btn
                                            size="x-large"
                                            color="indigo"
                                            variant="elevated"
                                            prepend-icon="mdi-qrcode-scan"
                                            @click="startVPVerification"
                                        >
                                            開始驗證
                                        </v-btn>
                                    </div>
                                </v-card-text>
                            </v-stepper-window-item>

                            <!-- Step 2: 填寫車輛資料 -->
                            <v-stepper-window-item :value="2">
                                <v-card-text class="pa-8">
                                    <v-alert type="success" variant="tonal" class="mb-6">
                                        <v-alert-title>
                                            <v-icon>mdi-check-circle</v-icon>
                                            員工證驗證成功
                                        </v-alert-title>
                                        <div class="mt-2">請填寫要登記的車輛資訊，可登記多台車輛。</div>
                                    </v-alert>

                                    <v-form ref="vehicleForm">
                                        <div v-for="(vehicle, index) in vehicles" :key="index" class="mb-6 pa-4 border rounded">
                                            <div class="d-flex justify-space-between align-center mb-3">
                                                <h4>車輛 {{ index + 1 }}</h4>
                                                <v-btn
                                                    v-if="vehicles.length > 1"
                                                    icon="mdi-delete"
                                                    variant="text"
                                                    color="error"
                                                    size="small"
                                                    @click="removeVehicle(index)"
                                                ></v-btn>
                                            </div>
                                            <v-row>
                                                <v-col cols="12" md="6">
                                                    <v-text-field
                                                        v-model="vehicle.vehicle_plate_number"
                                                        label="車牌號碼 *"
                                                        prepend-inner-icon="mdi-card-text"
                                                        :rules="[v => !!v || '請輸入車牌號碼']"
                                                        required
                                                        variant="outlined"
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" md="6">
                                                    <v-select
                                                        v-model="vehicle.vehicle_type"
                                                        :items="vehicleTypes"
                                                        label="車種 *"
                                                        prepend-inner-icon="mdi-car"
                                                        :rules="[v => !!v || '請選擇車種']"
                                                        required
                                                        variant="outlined"
                                                    ></v-select>
                                                </v-col>
                                                <v-col cols="12" md="6">
                                                    <v-text-field
                                                        v-model="vehicle.brand_model"
                                                        label="廠牌與車型 *"
                                                        prepend-inner-icon="mdi-car-info"
                                                        :rules="[v => !!v || '請輸入廠牌與車型']"
                                                        required
                                                        variant="outlined"
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" md="6">
                                                    <v-text-field
                                                        v-model="vehicle.color"
                                                        label="車色 *"
                                                        prepend-inner-icon="mdi-palette"
                                                        :rules="[v => !!v || '請輸入車色']"
                                                        required
                                                        variant="outlined"
                                                    ></v-text-field>
                                                </v-col>
                                            </v-row>
                                        </div>

                                        <v-btn
                                            color="indigo"
                                            variant="outlined"
                                            prepend-icon="mdi-plus"
                                            @click="addVehicle"
                                            class="mb-4"
                                        >
                                            新增車輛
                                        </v-btn>
                                    </v-form>
                                </v-card-text>

                                <v-card-actions class="pa-6">
                                    <v-btn variant="outlined" @click="currentStep = 1">
                                        上一步
                                    </v-btn>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="indigo"
                                        variant="elevated"
                                        size="large"
                                        @click="submitApplication"
                                        :loading="submitting"
                                    >
                                        提交申請
                                    </v-btn>
                                </v-card-actions>
                            </v-stepper-window-item>

                            <!-- Step 3: 申請成功 -->
                            <v-stepper-window-item :value="3">
                                <v-card-text class="pa-8 text-center">
                                    <v-icon size="120" color="success" class="mb-4">
                                        mdi-check-circle
                                    </v-icon>
                                    <div class="text-h4 mb-2">停車證領取成功！</div>
                                    <div class="text-body-1 text-grey mb-6">
                                        您的停車證已成功發行
                                    </div>

                                    <v-alert type="success" variant="tonal" class="mb-6">
                                        <v-alert-title>申請資訊</v-alert-title>
                                        <div class="text-body-2 mt-2">
                                            <strong>停車證編號：</strong>{{ permitId }}
                                        </div>
                                        <div class="text-body-2">
                                            <strong>登記車輛：</strong>{{ vehicles.length }} 台
                                        </div>
                                    </v-alert>

                                    <div class="mt-6">
                                        <v-btn color="primary" variant="elevated" @click="goBack">
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
                <v-card-title class="bg-indigo">
                    <v-icon class="mr-2">mdi-qrcode-scan</v-icon>
                    驗證員工證
                </v-card-title>
                <v-card-text class="pa-6">
                    <VPQRCodeScanner
                        ref="vpScanner"
                        vpRef="00000000_vp_employee_login"
                        :apiEndpoint="'/api/parking-permits/generate-verification-qr'"
                        :statusEndpoint="'/api/test/vp/result'"
                        successMessage="員工證驗證成功"
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

        <!-- 編輯車輛資訊對話框 -->
        <v-dialog v-model="showEditVehicles" max-width="900" persistent>
            <v-card>
                <v-card-title class="bg-primary">
                    <v-icon class="mr-2">mdi-pencil</v-icon>
                    編輯車輛資訊
                </v-card-title>
                <v-card-text class="pa-6">
                    <v-form ref="editVehicleForm">
                        <div v-for="(vehicle, index) in editingVehicles" :key="index" class="mb-6 pa-4 border rounded">
                            <div class="d-flex justify-space-between align-center mb-3">
                                <h4>車輛 {{ index + 1 }}</h4>
                                <v-btn
                                    v-if="editingVehicles.length > 1"
                                    icon="mdi-delete"
                                    variant="text"
                                    color="error"
                                    size="small"
                                    @click="removeEditingVehicle(index)"
                                ></v-btn>
                            </div>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-text-field
                                        v-model="vehicle.vehicle_plate_number"
                                        label="車牌號碼 *"
                                        prepend-inner-icon="mdi-card-text"
                                        :rules="[v => !!v || '請輸入車牌號碼']"
                                        required
                                        variant="outlined"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-select
                                        v-model="vehicle.vehicle_type"
                                        :items="vehicleTypes"
                                        label="車種 *"
                                        prepend-inner-icon="mdi-car"
                                        :rules="[v => !!v || '請選擇車種']"
                                        required
                                        variant="outlined"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-text-field
                                        v-model="vehicle.brand_model"
                                        label="廠牌與車型 *"
                                        prepend-inner-icon="mdi-car-info"
                                        :rules="[v => !!v || '請輸入廠牌與車型']"
                                        required
                                        variant="outlined"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <v-text-field
                                        v-model="vehicle.color"
                                        label="車色 *"
                                        prepend-inner-icon="mdi-palette"
                                        :rules="[v => !!v || '請輸入車色']"
                                        required
                                        variant="outlined"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </div>

                        <v-btn
                            color="primary"
                            variant="outlined"
                            prepend-icon="mdi-plus"
                            @click="addEditingVehicle"
                            class="mb-4"
                        >
                            新增車輛
                        </v-btn>
                    </v-form>
                </v-card-text>
                <v-card-actions class="pa-4">
                    <v-btn variant="text" @click="closeEditVehicles">取消</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="primary"
                        variant="elevated"
                        @click="saveVehicles"
                        :loading="savingVehicles"
                    >
                        儲存變更
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- VC 領取對話框 -->
        <v-dialog v-model="showVCDialog" max-width="600" persistent>
            <v-card>
                <v-card-title class="bg-indigo">
                    <v-icon class="mr-2">mdi-qrcode</v-icon>
                    領取停車證
                </v-card-title>
                <v-card-text class="pa-6">
                    <VCQRCodeScanner
                        v-if="vcQRData"
                        ref="vcScanner"
                        :pre-generated-data="vcQRData"
                        :status-endpoint="`/api/vc/status/${vcQRData.transactionId}`"
                        :show-initial-button="false"
                        :auto-generate="true"
                        success-message="停車證已成功領取到您的數位皮夾中"
                        @success="handleVCSuccess"
                        @error="handleVCError"
                    />
                </v-card-text>
            </v-card>
        </v-dialog>

        <!-- 換發確認對話框 -->
        <v-dialog v-model="showReissueConfirm" max-width="600">
            <v-card>
                <v-card-title class="bg-warning">
                    <v-icon class="mr-2">mdi-alert</v-icon>
                    確認換發停車證
                </v-card-title>
                <v-card-text class="pa-6">
                    <v-alert type="warning" variant="tonal" prominent class="mb-4">
                        <v-alert-title>重要提醒</v-alert-title>
                        <div class="mt-2">
                            換發停車證將會：
                            <ul class="mt-2">
                                <li><strong>撤銷舊的停車證 VC</strong>（舊憑證將無法使用）</li>
                                <li>需要重新驗證員工證並填寫車輛資料</li>
                                <li>發行新的停車證憑證</li>
                            </ul>
                        </div>
                    </v-alert>
                    <div class="text-body-1">
                        <strong>注意：</strong>僅在停車證遺失時才需要換發。如只需更新車輛資訊，請使用「編輯車輛資訊」功能。
                    </div>
                </v-card-text>
                <v-card-actions class="pa-4">
                    <v-spacer></v-spacer>
                    <v-btn variant="text" @click="showReissueConfirm = false">取消</v-btn>
                    <v-btn
                        color="warning"
                        variant="elevated"
                        @click="startReissue"
                        :loading="reissuing"
                    >
                        確認換發
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import VCQRCodeScanner from '../components/VCQRCodeScanner.vue'
import VPQRCodeScanner from '../components/VPQRCodeScanner.vue'

const router = useRouter()

const loading = ref(true)
const hasPermit = ref(false)
const permit = ref(null)

const currentStep = ref(1)
const vpTransactionId = ref('')

// VP 驗證對話框
const showVPDialog = ref(false)
const vpScanner = ref(null)

// 錯誤提示
const errorSnackbar = ref(false)
const errorMessage = ref('')

// 換發相關
const showReissueConfirm = ref(false)
const reissuing = ref(false)

// 編輯車輛相關
const showEditVehicles = ref(false)
const editingVehicles = ref([])
const editVehicleForm = ref(null)
const savingVehicles = ref(false)

// VC 領取相關
const showVCDialog = ref(false)
const vcScanner = ref(null)

const vehicles = ref([
    {
        vehicle_plate_number: '',
        vehicle_type: '',
        brand_model: '',
        color: ''
    }
])
const vehicleTypes = ['小客車', '機車', 'SUV', '貨車', '其他']
const vehicleForm = ref(null)
const submitting = ref(false)

const permitId = ref('')
const vcQRData = ref(null)

onMounted(async () => {
    await fetchPermitStatus()
})

// 查詢停車證狀態
const fetchPermitStatus = async () => {
    loading.value = true
    try {
        const token = localStorage.getItem('auth_token')
        const response = await fetch('/api/parking-permits', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        })

        if (response.ok) {
            const data = await response.json()
            hasPermit.value = data.has_permit
            if (data.has_permit) {
                permit.value = data.data
            }
        }
    } catch (error) {
        console.error('查詢停車證失敗:', error)
    } finally {
        loading.value = false
    }
}

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
    vpTransactionId.value = result.transactionId

    try {
        // 呼叫後端 API 驗證員工證資料
        const token = localStorage.getItem('auth_token')
        const response = await fetch('/api/parking-permits/verify-employee-credential', {
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

// 新增車輛
const addVehicle = () => {
    vehicles.value.push({
        vehicle_plate_number: '',
        vehicle_type: '',
        brand_model: '',
        color: ''
    })
}

// 移除車輛
const removeVehicle = (index) => {
    vehicles.value.splice(index, 1)
}

// 提交申請
const submitApplication = async () => {
    const { valid } = await vehicleForm.value.validate()
    if (!valid) {
        return
    }

    submitting.value = true

    try {
        const token = localStorage.getItem('auth_token')
        const response = await fetch('/api/parking-permits/apply', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                vp_transaction_id: vpTransactionId.value,
                vehicles: vehicles.value
            })
        })

        const data = await response.json()

        if (response.ok && data.success) {
            permitId.value = data.data.permit_id
            vcQRData.value = {
                transactionId: data.data.transaction_id,
                qrCode: data.data.qr_code,
                deepLink: data.data.deep_link
            }

            // 打開 VC 領取彈窗（VCQRCodeScanner 會自動開始輪詢）
            showVCDialog.value = true
        } else {
            errorMessage.value = data.message || '提交申請失敗'
            errorSnackbar.value = true
        }
    } catch (error) {
        alert('提交申請時發生錯誤')
    } finally {
        submitting.value = false
    }
}

// VC 領取成功
const handleVCSuccess = async (result) => {
    // 等待 3 秒讓用戶看到成功訊息
    setTimeout(() => {
        showVCDialog.value = false
        currentStep.value = 3
    }, 3000)
}

// VC 領取失敗
const handleVCError = (error) => {
    errorMessage.value = error
    errorSnackbar.value = true
}

// 開啟編輯車輛對話框
const openEditVehicles = () => {
    // 深拷貝現有車輛資料
    editingVehicles.value = JSON.parse(JSON.stringify(permit.value.vehicles || []))

    // 確保至少有一台車輛
    if (editingVehicles.value.length === 0) {
        editingVehicles.value.push({
            vehicle_plate_number: '',
            vehicle_type: '',
            brand_model: '',
            color: ''
        })
    }

    showEditVehicles.value = true
}

// 關閉編輯車輛對話框
const closeEditVehicles = () => {
    showEditVehicles.value = false
    editingVehicles.value = []
    if (editVehicleForm.value) {
        editVehicleForm.value.resetValidation()
    }
}

// 新增編輯中的車輛
const addEditingVehicle = () => {
    editingVehicles.value.push({
        vehicle_plate_number: '',
        vehicle_type: '',
        brand_model: '',
        color: ''
    })
}

// 移除編輯中的車輛
const removeEditingVehicle = (index) => {
    editingVehicles.value.splice(index, 1)
}

// 儲存車輛資訊
const saveVehicles = async () => {
    const { valid } = await editVehicleForm.value.validate()
    if (!valid) {
        return
    }

    savingVehicles.value = true

    try {
        const token = localStorage.getItem('auth_token')
        const response = await fetch('/api/parking-permits/update-vehicles', {
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                vehicles: editingVehicles.value
            })
        })

        const data = await response.json()

        if (response.ok && data.success) {
            // 更新本地停車證資料
            permit.value.vehicles = data.data.vehicles
            closeEditVehicles()

            // 顯示成功訊息
            errorMessage.value = '車輛資訊更新成功'
            errorSnackbar.value = true
        } else {
            throw new Error(data.message || '更新失敗')
        }
    } catch (error) {
        errorMessage.value = error.message
        errorSnackbar.value = true
    } finally {
        savingVehicles.value = false
    }
}

// 開始換發流程
const startReissue = async () => {
    reissuing.value = true

    try {
        const token = localStorage.getItem('auth_token')
        const response = await fetch('/api/parking-permits/reissue', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        })

        const data = await response.json()

        if (response.ok && data.success) {
            showReissueConfirm.value = false
            // 重置狀態，進入申請流程
            hasPermit.value = false
            permit.value = null
            currentStep.value = 1
            vpTransactionId.value = ''
            vehicles.value = [{
                vehicle_plate_number: '',
                vehicle_type: '',
                brand_model: '',
                color: ''
            }]
        } else {
            throw new Error(data.message || '換發失敗')
        }
    } catch (error) {
        errorMessage.value = error.message
        errorSnackbar.value = true
    } finally {
        reissuing.value = false
    }
}

// 返回
const goBack = () => {
    router.push({ name: 'Dashboard' })
}
</script>

<style scoped>
.parking-permit-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 40px 20px;
}

.qr-code-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    margin: 0 auto;
}

.qr-code-image {
    max-width: 100%;
    height: auto;
    display: block;
}

.manual-claim-section {
    background: #f5f5f5;
    padding: 24px;
    border-radius: 8px;
    max-width: 600px;
    margin: 0 auto;
}
</style>
