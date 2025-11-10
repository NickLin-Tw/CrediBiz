<template>
    <v-container fluid class="apply-page">
        <v-row justify="center">
            <v-col cols="12" md="10" lg="8">
                <v-card class="application-card" elevation="8" rounded="lg">
                    <!-- Header -->
                    <v-card-title class="card-header">
                        <v-btn
                            icon="mdi-arrow-left"
                            variant="text"
                            @click="goBack"
                            class="mr-2"
                        ></v-btn>
                        <div>
                            <h1 class="text-h4">臺灣航空職位應徵</h1>
                            <p class="text-subtitle-1 text-medium-emphasis mt-1">Cabin Crew 招募申請表</p>
                        </div>
                    </v-card-title>

                    <v-divider></v-divider>

                    <v-card-text class="pa-6">
                        <!-- VP 自動匯入按鈕 -->
                        <v-alert
                            v-if="!vpVerified"
                            type="info"
                            variant="tonal"
                            class="mb-6"
                        >
                            <v-alert-title class="d-flex align-center justify-space-between">
                                <span>使用數位憑證快速填寫</span>
                                <v-btn
                                    color="primary"
                                    variant="elevated"
                                    prepend-icon="mdi-qrcode-scan"
                                    @click="startVPVerification"
                                    :loading="vpLoading"
                                >
                                    從憑證自動匯入資料
                                </v-btn>
                            </v-alert-title>
                            <div class="mt-2">
                                透過掃描 QR Code，自動匯入您的身份證、學歷證書及多益成績資料
                            </div>
                        </v-alert>

                        <!-- VP 驗證成功提示 -->
                        <v-alert
                            v-if="vpVerified"
                            type="success"
                            variant="tonal"
                            class="mb-6"
                        >
                            <v-alert-title>✓ 憑證驗證成功</v-alert-title>
                            <div>已自動匯入您的資料，請確認後提交申請</div>
                        </v-alert>

                        <!-- VP QR Code 對話框 -->
                        <v-dialog v-model="showVPDialog" max-width="700" persistent>
                            <v-card>
                                <v-card-title class="text-h5 pa-4">
                                    掃描 QR Code 驗證身份
                                    <v-btn
                                        icon="mdi-close"
                                        variant="text"
                                        size="small"
                                        class="float-right"
                                        @click="cancelVPVerification"
                                    ></v-btn>
                                </v-card-title>

                                <v-card-text class="pa-6">
                                    <!-- 使用 VP QR Code Scanner 元件 -->
                                    <VPQRCodeScanner
                                        ref="vpScanner"
                                        vp-ref="00000000_vp_recruitment"
                                        success-message="已自動匯入您的資料，請確認後提交申請"
                                        auto-start
                                        @success="handleVPSuccess"
                                        @error="handleVPError"
                                    />
                                </v-card-text>
                            </v-card>
                        </v-dialog>

                        <!-- 應徵表單 -->
                        <v-form ref="formRef" v-model="formValid" @submit.prevent="submitApplication">
                            <!-- 基本資料區塊 -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <v-icon>mdi-account</v-icon>
                                    基本資料
                                </h3>

                                <v-row>
                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="formData.name"
                                            label="姓名"
                                            :rules="rules.name"
                                            :readonly="fieldsVerified.name"
                                            required
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.name">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="formData.id_number"
                                            label="身分證字號"
                                            :rules="rules.id_number"
                                            :readonly="fieldsVerified.id_number"
                                            placeholder="A123456789"
                                            required
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.id_number">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="formData.roc_birthday"
                                            label="民國出生年月日"
                                            :rules="rules.roc_birthday"
                                            :readonly="fieldsVerified.roc_birthday"
                                            placeholder="0850315"
                                            hint="格式：YYYMMDD（例如：0850315 = 民國85年3月15日）"
                                            persistent-hint
                                            required
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.roc_birthday">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="formData.registered_address"
                                            label="戶籍地址"
                                            :rules="rules.registered_address"
                                            :readonly="fieldsVerified.registered_address"
                                            placeholder="台北市大安區信義路四段1號"
                                            required
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.registered_address">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>
                                </v-row>
                            </div>

                            <v-divider class="my-6"></v-divider>

                            <!-- 學歷資料區塊 -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <v-icon>mdi-school</v-icon>
                                    學歷資料
                                </h3>

                                <v-row>
                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="formData.degree_name"
                                            label="學位名稱"
                                            :rules="rules.degree_name"
                                            :readonly="fieldsVerified.degree_name"
                                            placeholder="例如：學士學位"
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.degree_name">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="formData.degree_level"
                                            label="學位層級"
                                            :rules="rules.degree_level"
                                            :readonly="fieldsVerified.degree_level"
                                            placeholder="例如：學士"
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.degree_level">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="formData.major"
                                            label="主修科系"
                                            :rules="rules.major"
                                            :readonly="fieldsVerified.major"
                                            placeholder="例如：觀光管理系"
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.major">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="formData.graduation_date"
                                            label="畢業日期"
                                            :rules="rules.graduation_date"
                                            :readonly="fieldsVerified.graduation_date"
                                            type="date"
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.graduation_date">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="formData.education_institution"
                                            label="畢業學校"
                                            :rules="rules.education_institution"
                                            :readonly="fieldsVerified.education_institution"
                                            placeholder="例如：國立臺灣大學"
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.education_institution">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>
                                </v-row>
                            </div>

                            <v-divider class="my-6"></v-divider>

                            <!-- 英文能力區塊 -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <v-icon>mdi-translate</v-icon>
                                    英文能力（多益成績）
                                </h3>

                                <v-row>
                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="formData.test_name"
                                            label="測驗名稱"
                                            :rules="rules.test_name"
                                            :readonly="fieldsVerified.test_name"
                                            placeholder="例如：TOEIC"
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.test_name">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field
                                            v-model="formData.test_date"
                                            label="測驗日期"
                                            :rules="rules.test_date"
                                            :readonly="fieldsVerified.test_date"
                                            type="date"
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.test_date">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="4">
                                        <v-text-field
                                            v-model.number="formData.score_listening"
                                            label="聽力分數"
                                            :rules="rules.score_listening"
                                            :readonly="fieldsVerified.score_listening"
                                            placeholder="000-495"
                                            type="number"
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.score_listening">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="4">
                                        <v-text-field
                                            v-model.number="formData.score_reading"
                                            label="閱讀分數"
                                            :rules="rules.score_reading"
                                            :readonly="fieldsVerified.score_reading"
                                            placeholder="000-495"
                                            type="number"
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.score_reading">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="4">
                                        <v-text-field
                                            v-model.number="formData.score_total"
                                            label="總分"
                                            :rules="rules.score_total"
                                            :readonly="fieldsVerified.score_total"
                                            placeholder="000-990"
                                            type="number"
                                            variant="outlined"
                                            density="comfortable"
                                        >
                                            <template v-slot:append-inner v-if="fieldsVerified.score_total">
                                                <v-icon color="success">mdi-check-circle</v-icon>
                                            </template>
                                        </v-text-field>
                                    </v-col>
                                </v-row>
                            </div>

                            <v-divider class="my-6"></v-divider>

                            <!-- 提交按鈕 -->
                            <div class="text-center">
                                <div class="d-flex justify-center gap-4 mb-2">
                                    <v-btn
                                        type="submit"
                                        color="primary"
                                        size="x-large"
                                        variant="elevated"
                                        :loading="submitLoading"
                                        :disabled="!formValid || !vpVerified || !allRequiredFieldsFilled"
                                        class="px-12"
                                    >
                                        <v-icon start>mdi-send</v-icon>
                                        提交申請
                                    </v-btn>
                                    <v-btn
                                        color="error"
                                        size="x-large"
                                        variant="outlined"
                                        @click="clearAllData"
                                        :disabled="submitLoading"
                                        class="px-8"
                                    >
                                        <v-icon start>mdi-refresh</v-icon>
                                        清除資料
                                    </v-btn>
                                </div>
                                <p v-if="!vpTransactionId" class="text-caption text-medium-emphasis mt-2">
                                    除了手動填寫，也可以利用憑證自動匯入已被信任的憑證中包含的個人資料
                                </p>
                                <p v-else-if="!allRequiredFieldsFilled" class="text-caption text-error mt-2">
                                    請填寫所有必填欄位
                                </p>
                            </div>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>

        <!-- 錯誤提示 Snackbar -->
        <v-snackbar
            v-model="showError"
            color="error"
            :timeout="5000"
        >
            {{ errorMessage }}
            <template v-slot:actions>
                <v-btn variant="text" @click="showError = false">關閉</v-btn>
            </template>
        </v-snackbar>
    </v-container>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { useRouter } from 'vue-router'
import VPQRCodeScanner from '@/components/VPQRCodeScanner.vue'

const router = useRouter()

// 表單狀態
const formRef = ref(null)
const formValid = ref(false)
const submitLoading = ref(false)

// VP 驗證狀態
const vpVerified = ref(false)
const vpTransactionId = ref(null)
const showVPDialog = ref(false)
const vpScanner = ref(null)

// 錯誤處理
const showError = ref(false)
const errorMessage = ref('')

// 表單資料
const formData = reactive({
    name: '',
    id_number: '',
    roc_birthday: '',
    registered_address: '',
    degree_name: '',
    degree_level: '',
    major: '',
    graduation_date: '',
    education_institution: '',
    test_name: '',
    test_date: '',
    score_listening: null,
    score_reading: null,
    score_total: null
})

// 欄位驗證狀態（從 VP 匯入的欄位會標記為已驗證）
const fieldsVerified = reactive({
    name: false,
    id_number: false,
    roc_birthday: false,
    registered_address: false,
    degree_name: false,
    degree_level: false,
    major: false,
    graduation_date: false,
    education_institution: false,
    test_name: false,
    test_date: false,
    score_listening: false,
    score_reading: false,
    score_total: false
})

// 追蹤哪些欄位來自 VP（用於判斷提交時要傳送哪些欄位）
const fieldsFromVP = reactive({
    name: false,
    id_number: false,
    roc_birthday: false,
    registered_address: false,
    degree_name: false,
    degree_level: false,
    major: false,
    graduation_date: false,
    education_institution: false,
    test_name: false,
    test_date: false,
    score_listening: false,
    score_reading: false,
    score_total: false
})

// 中華民國身分證字號驗證
const validateROCIdNumber = (idNumber) => {
    // 格式檢查：1個大寫字母 + 1個數字(1或2) + 8個數字
    if (!/^[A-Z][12]\d{8}$/.test(idNumber)) {
        return false
    }

    // 字母對應數字表（A=10, B=11, ..., Z=35）
    const letterToNumber = {
        A: 10, B: 11, C: 12, D: 13, E: 14, F: 15, G: 16, H: 17, I: 34, J: 18,
        K: 19, L: 20, M: 21, N: 22, O: 35, P: 23, Q: 24, R: 25, S: 26, T: 27,
        U: 28, V: 29, W: 32, X: 30, Y: 31, Z: 33
    }

    // 取得字母對應的數字
    const firstLetter = idNumber[0]
    const letterNum = letterToNumber[firstLetter]

    // 將字母數字拆成兩位數
    const n1 = Math.floor(letterNum / 10)
    const n2 = letterNum % 10

    // 取得後面9個數字
    const digits = idNumber.substring(1).split('').map(Number)

    // 計算檢查碼
    // 公式：n1*1 + n2*9 + d1*8 + d2*7 + d3*6 + d4*5 + d5*4 + d6*3 + d7*2 + d8*1 + d9*1
    const sum = n1 * 1 + n2 * 9 +
                digits[0] * 8 +
                digits[1] * 7 +
                digits[2] * 6 +
                digits[3] * 5 +
                digits[4] * 4 +
                digits[5] * 3 +
                digits[6] * 2 +
                digits[7] * 1 +
                digits[8] * 1

    // 檢查碼應該要能被10整除
    return sum % 10 === 0
}

// 驗證規則
const rules = {
    name: [
        v => !!v || '姓名為必填項',
        v => /^[a-zA-Z0-9_\u4e00-\u9fa5]+$/.test(v) || '只能輸入中英文數字和_'
    ],
    id_number: [
        v => !!v || '身分證字號為必填項',
        v => /^[A-Z][12][0-9]{8}$/.test(v) || '身分證字號格式錯誤（例如：A123456789）',
        v => validateROCIdNumber(v) || '身分證字號檢查碼錯誤，請確認是否輸入正確'
    ],
    roc_birthday: [
        v => !!v || '出生年月日為必填項',
        v => /^[0-9]{7}$/.test(v) || '格式錯誤，須為7碼數字（例如：0850315）'
    ],
    registered_address: [
        v => !!v || '戶籍地址為必填項',
        v => /^[a-zA-Z0-9_\u4e00-\u9fa5]+$/.test(v) || '只能輸入中英文數字和_'
    ],
    degree_name: [
        v => !v || /^[^~!@#$%^&*()\-+*/]+$/.test(v) || '不允許輸入~!@#$%^&*()_-+*/'
    ],
    degree_level: [
        v => !v || /^[^~!@#$%^&*()\-+*/]+$/.test(v) || '不允許輸入~!@#$%^&*()_-+*/'
    ],
    major: [
        v => !v || /^[^~!@#$%^&*()\-+*/]+$/.test(v) || '不允許輸入~!@#$%^&*()_-+*/'
    ],
    graduation_date: [
        v => !v || /^\d{4}-\d{2}-\d{2}$/.test(v) || '日期格式錯誤（YYYY-MM-DD）'
    ],
    education_institution: [
        v => !v || /^[^~!@#$%^&*()\-+*/]+$/.test(v) || '不允許輸入~!@#$%^&*()_-+*/'
    ],
    test_name: [
        v => !v || /^[a-zA-Z0-9]+$/.test(v) || '只能輸入英文字母和數字'
    ],
    test_date: [
        v => !v || /^\d{4}-\d{2}-\d{2}$/.test(v) || '日期格式錯誤（YYYY-MM-DD）'
    ],
    score_listening: [
        v => v === null || v === '' || (Number.isInteger(v) && v >= 0 && v <= 495) || '聽力分數範圍：0-495'
    ],
    score_reading: [
        v => v === null || v === '' || (Number.isInteger(v) && v >= 0 && v <= 495) || '閱讀分數範圍：0-495'
    ],
    score_total: [
        v => v === null || v === '' || (Number.isInteger(v) && v >= 0 && v <= 990) || '總分範圍：0-990'
    ]
}

// 檢查所有必填欄位是否都已填寫
const allRequiredFieldsFilled = computed(() => {
    // 必填欄位列表
    const requiredFields = ['name', 'id_number', 'roc_birthday', 'registered_address']

    // 檢查所有必填欄位是否都有值
    return requiredFields.every(field => {
        const value = formData[field]
        return value !== '' && value !== null && value !== undefined
    })
})

// 清除所有資料
const clearAllData = () => {
    // 重置表單資料
    Object.keys(formData).forEach(key => {
        if (typeof formData[key] === 'number') {
            formData[key] = null
        } else {
            formData[key] = ''
        }
    })

    // 重置驗證狀態
    Object.keys(fieldsVerified).forEach(key => {
        fieldsVerified[key] = false
    })

    // 重置 VP 來源標記
    Object.keys(fieldsFromVP).forEach(key => {
        fieldsFromVP[key] = false
    })

    // 重置 VP 驗證狀態
    vpVerified.value = false
    vpTransactionId.value = null

    // 重置表單驗證
    formRef.value?.reset()
    formRef.value?.resetValidation()
}

// 開始 VP 驗證
const startVPVerification = () => {
    showVPDialog.value = true
}

// 處理 VP 驗證成功
const handleVPSuccess = ({ transactionId, vpData }) => {
    try {
        const credentials = vpData || []

        // 提取所有 VC 的資料
        const allClaims = {}
        const names = []

        credentials.forEach(vc => {
            vc.claims.forEach(claim => {
                if (claim.ename === 'name') {
                    names.push(claim.value)
                }
                allClaims[claim.ename] = claim.value
            })
        })

        // 驗證所有 VC 的 name 是否一致
        if (names.length > 0 && !names.every(name => name === names[0])) {
            errorMessage.value = '驗證失敗：不同憑證中的姓名不一致'
            showError.value = true
            showVPDialog.value = false
            return
        }

        // 欄位名稱對應表（VP 欄位名 -> formData 欄位名）
        const fieldMapping = {
            'institution': 'education_institution'  // VP 的 institution 對應到 formData 的 education_institution
        }

        // 需要轉換為數字的欄位
        const numericFields = ['score_listening', 'score_reading', 'score_total']

        // 填入表單資料（只用於顯示）並標記來源
        Object.keys(allClaims).forEach(key => {
            // 取得對應的表單欄位名稱（如果有 mapping 則使用，否則直接使用原名稱）
            const formFieldName = fieldMapping[key] || key

            if (formFieldName in formData) {
                let value = allClaims[key]

                // 如果是數字欄位，轉換為整數
                if (numericFields.includes(formFieldName)) {
                    value = parseInt(value, 10)
                }

                formData[formFieldName] = value
                fieldsVerified[formFieldName] = true  // 標記為已驗證（顯示綠色打勾）
                fieldsFromVP[formFieldName] = true    // 標記為來自 VP（提交時排除）
            }
        })

        // 檢查是否有多益證書但缺少 test_name，自動填入預設值
        const hasToeicCert = credentials.some(vc => vc.credentialType === '00000000_toeic_test_cert')
        if (hasToeicCert && !formData.test_name) {
            formData.test_name = 'TOEIC'
            fieldsVerified.test_name = true
            fieldsFromVP.test_name = true
        }

        // 儲存 VP Transaction ID（真正要提交給後端的）
        vpTransactionId.value = transactionId
        vpVerified.value = true
        showVPDialog.value = false

    } catch (error) {
        errorMessage.value = '資料解析失敗：' + error.message
        showError.value = true
        showVPDialog.value = false
    }
}

// 處理 VP 驗證錯誤
const handleVPError = (error) => {
    errorMessage.value = error
    showError.value = true
}

// 取消 VP 驗證
const cancelVPVerification = () => {
    vpScanner.value?.cancel()
    showVPDialog.value = false
}

// 提交申請
const submitApplication = async () => {
    if (!vpTransactionId.value) {
        errorMessage.value = '請先完成身份驗證'
        showError.value = true
        return
    }

    submitLoading.value = true

    try {
        // 只收集手動填寫的欄位（不包含來自 VP 的欄位）
        const manualFields = {}

        Object.keys(formData).forEach(key => {
            // 如果欄位不是來自 VP，且有值，則加入 manualFields
            if (!fieldsFromVP[key]) {
                const value = formData[key]
                // 只傳送有值的欄位（排除空字串、null、undefined）
                if (value !== '' && value !== null && value !== undefined) {
                    manualFields[key] = value
                }
            }
        })

        const response = await fetch('/api/applications', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                vp_transaction_id: vpTransactionId.value,
                manual_fields: manualFields
            })
        })

        const data = await response.json()

        if (!response.ok) {
            throw new Error(data.message || '提交失敗')
        }

        // 成功 - 導向錄取通知頁面
        router.push({
            name: 'Congratulations',
            query: {
                employee_id: data.employee.employee_id,
                token: data.employee.credential_token
            }
        })
    } catch (error) {
        errorMessage.value = error.message
        showError.value = true
    } finally {
        submitLoading.value = false
    }
}

// 返回首頁
const goBack = () => {
    router.push({ name: 'Home' })
}
</script>

<style scoped>
.apply-page {
    min-height: 100vh;
    padding: 40px 20px;
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
}

.application-card {
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1) !important;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 24px !important;
}

.form-section {
    margin-bottom: 24px;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #e0e0e0;
}

.gap-4 {
    gap: 16px;
}

/* 響應式設計 */
@media (max-width: 600px) {
    .apply-page {
        padding: 20px 10px;
    }

    .card-header {
        padding: 16px !important;
    }

    .section-title {
        font-size: 1.1rem;
    }
}
</style>
