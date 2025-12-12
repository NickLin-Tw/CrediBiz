<template>
    <v-container fluid class="prerequisite-vc-page">
        <v-row justify="center">
            <v-col cols="12" md="10" lg="8">
                <v-card class="main-card" elevation="8" rounded="lg">
                    <!-- Header -->
                    <v-card-title class="card-header">
                        <v-btn
                            icon="mdi-arrow-left"
                            variant="text"
                            @click="goBack"
                            class="mr-2"
                        />
                        <div>
                            <h1 class="text-h4">領取前置 VC</h1>
                            <p class="text-subtitle-1 text-medium-emphasis mt-1">
                                請先領取前三張數位憑證（身分證、學位證書、多益證書），完成後即可前往應徵職位。醫療診斷證明可視需求多次領取。
                            </p>
                        </div>
                    </v-card-title>

                    <v-divider />

                    <v-card-text class="pa-6">
                        <!-- 免責聲明 -->
                        <v-alert
                            type="warning"
                            variant="tonal"
                            prominent
                            border="start"
                            class="mb-6"
                        >
                            <v-alert-title>
                                免責聲明
                            </v-alert-title>
                            <div class="mt-2">
                                本頁面為<strong>模擬政府或第三方機構發行數位憑證</strong>之功能，僅供本場景擬真模擬測試使用。頁面所產生之所有資料均為<strong>隨機產生</strong>，如與真實人物、機構或事件有任何雷同，純屬巧合，<strong>並非惡意冒用身分</strong>。本系統不會儲存或濫用任何個人資料。
                            </div>
                        </v-alert>

                        <!-- 錯誤訊息 -->
                        <v-alert
                            v-if="showError"
                            type="error"
                            variant="tonal"
                            closable
                            @click:close="showError = false"
                            class="mb-6"
                        >
                            {{ errorMessage }}
                        </v-alert>

                        <!-- VC 卡片列表 -->
                        <v-row>
                    <!-- 1. 中華民國數位身分證 -->
                    <v-col cols="12">
                        <v-card class="vc-card" elevation="4" rounded="lg">
                            <v-card-title class="card-header">
                                <v-icon size="large" class="mr-3">mdi-card-account-details</v-icon>
                                <div>
                                    <h2 class="text-h5">中華民國數位身分證</h2>
                                    <p class="text-caption mt-1">模板代碼：00000000_roc_did_vc</p>
                                </div>
                                <v-chip
                                    v-if="rocDidIssued"
                                    color="success"
                                    variant="flat"
                                    class="ml-auto"
                                >
                                    <v-icon start>mdi-check-circle</v-icon>
                                    已領取
                                </v-chip>
                            </v-card-title>

                            <v-divider />

                            <v-card-text class="pa-6">
                                <v-form ref="form1" v-model="form1Valid">
                                    <v-row>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="rocDid.name"
                                                label="姓名"
                                                :rules="rules.name"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="rocDid.id_number"
                                                label="國民身分證統一編號"
                                                :rules="rules.id_number"
                                                variant="outlined"
                                                density="comfortable"
                                                placeholder="A123456789"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="rocDid.roc_birthday"
                                                label="民國出生年月日"
                                                :rules="rules.roc_birthday"
                                                variant="outlined"
                                                density="comfortable"
                                                placeholder="0850315"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="rocDid.registered_address"
                                                label="戶籍地址"
                                                :rules="rules.registered_address"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                    </v-row>

                                    <div class="d-flex gap-3 mt-4">
                                        <v-btn
                                            color="secondary"
                                            variant="outlined"
                                            @click="generateRocDidDefaults"
                                            prepend-icon="mdi-auto-fix"
                                        >
                                            自動填入範例資料
                                        </v-btn>
                                        <v-btn
                                            color="primary"
                                            variant="elevated"
                                            @click="issueRocDid"
                                            :disabled="!form1Valid || rocDidIssuing"
                                            :loading="rocDidIssuing"
                                            prepend-icon="mdi-qrcode"
                                        >
                                            領取身分證 VC
                                        </v-btn>
                                    </div>
                                </v-form>
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <!-- 2. 教育部數位學位證書 -->
                    <v-col cols="12">
                        <v-card class="vc-card" elevation="4" rounded="lg">
                            <v-card-title class="card-header">
                                <v-icon size="large" class="mr-3">mdi-school</v-icon>
                                <div>
                                    <h2 class="text-h5">教育部數位學位證書</h2>
                                    <p class="text-caption mt-1">模板代碼：00000000_moe_ndc</p>
                                </div>
                                <v-chip
                                    v-if="moeNdcIssued"
                                    color="success"
                                    variant="flat"
                                    class="ml-auto"
                                >
                                    <v-icon start>mdi-check-circle</v-icon>
                                    已領取
                                </v-chip>
                            </v-card-title>

                            <v-divider />

                            <v-card-text class="pa-6">
                                <v-form ref="form2" v-model="form2Valid">
                                    <v-row>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="moeNdc.name"
                                                label="姓名"
                                                :rules="rules.name"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="moeNdc.student_id"
                                                label="學號"
                                                :rules="rules.student_id"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="moeNdc.degree_name"
                                                label="學位名稱"
                                                :rules="rules.degree_name"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="moeNdc.degree_level"
                                                label="學位層級"
                                                :rules="rules.degree_level"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="moeNdc.major"
                                                label="主修科系"
                                                :rules="rules.major"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="moeNdc.graduation_date"
                                                label="畢業日期"
                                                :rules="rules.graduation_date"
                                                variant="outlined"
                                                density="comfortable"
                                                placeholder="YYYY-MM-DD"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="moeNdc.institution"
                                                label="簽證單位/發證單位"
                                                :rules="rules.institution"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                    </v-row>

                                    <div class="d-flex gap-3 mt-4">
                                        <v-btn
                                            color="secondary"
                                            variant="outlined"
                                            @click="generateMoeNdcDefaults"
                                            prepend-icon="mdi-auto-fix"
                                        >
                                            自動填入範例資料
                                        </v-btn>
                                        <v-btn
                                            color="primary"
                                            variant="elevated"
                                            @click="issueMoeNdc"
                                            :disabled="!form2Valid || moeNdcIssuing"
                                            :loading="moeNdcIssuing"
                                            prepend-icon="mdi-qrcode"
                                        >
                                            領取學位證書 VC
                                        </v-btn>
                                    </div>
                                </v-form>
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <!-- 3. 多益英文檢定證書 -->
                    <v-col cols="12">
                        <v-card class="vc-card" elevation="4" rounded="lg">
                            <v-card-title class="card-header">
                                <v-icon size="large" class="mr-3">mdi-certificate</v-icon>
                                <div>
                                    <h2 class="text-h5">多益英文檢定證書</h2>
                                    <p class="text-caption mt-1">模板代碼：00000000_toeic_test_cert</p>
                                </div>
                                <v-chip
                                    v-if="toeicIssued"
                                    color="success"
                                    variant="flat"
                                    class="ml-auto"
                                >
                                    <v-icon start>mdi-check-circle</v-icon>
                                    已領取
                                </v-chip>
                            </v-card-title>

                            <v-divider />

                            <v-card-text class="pa-6">
                                <v-form ref="form3" v-model="form3Valid">
                                    <v-row>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="toeicCert.name"
                                                label="姓名"
                                                :rules="rules.name"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="toeicCert.candidate_id"
                                                label="准考證號碼"
                                                :rules="rules.candidate_id"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="toeicCert.test_name"
                                                label="測驗名稱"
                                                :rules="rules.test_name"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="toeicCert.test_date"
                                                label="測驗日期"
                                                :rules="rules.test_date"
                                                variant="outlined"
                                                density="comfortable"
                                                placeholder="YYYY-MM-DD"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="4">
                                            <v-text-field
                                                v-model="toeicCert.score_listening"
                                                label="聽力分數"
                                                :rules="rules.score_listening"
                                                variant="outlined"
                                                density="comfortable"
                                                placeholder="000-495"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="4">
                                            <v-text-field
                                                v-model="toeicCert.score_reading"
                                                label="閱讀分數"
                                                :rules="rules.score_reading"
                                                variant="outlined"
                                                density="comfortable"
                                                placeholder="000-495"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="4">
                                            <v-text-field
                                                v-model="toeicCert.score_total"
                                                label="總分數"
                                                :rules="rules.score_total"
                                                variant="outlined"
                                                density="comfortable"
                                                placeholder="000-990"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="toeicCert.institution"
                                                label="簽證單位/發證單位"
                                                :rules="rules.institution"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                    </v-row>

                                    <div class="d-flex gap-3 mt-4">
                                        <v-btn
                                            color="secondary"
                                            variant="outlined"
                                            @click="generateToeicCertDefaults"
                                            prepend-icon="mdi-auto-fix"
                                        >
                                            自動填入範例資料
                                        </v-btn>
                                        <v-btn
                                            color="primary"
                                            variant="elevated"
                                            @click="issueToeicCert"
                                            :disabled="!form3Valid || toeicIssuing"
                                            :loading="toeicIssuing"
                                            prepend-icon="mdi-qrcode"
                                        >
                                            領取多益證書 VC
                                        </v-btn>
                                    </div>
                                </v-form>
                            </v-card-text>
                        </v-card>
                    </v-col>

                    <!-- 4. 醫療診斷證明憑證 -->
                    <v-col cols="12">
                        <v-card class="vc-card" elevation="4" rounded="lg">
                            <v-card-title class="card-header">
                                <v-icon size="large" class="mr-3">mdi-hospital-box</v-icon>
                                <div>
                                    <h2 class="text-h5">醫療診斷證明憑證</h2>
                                    <p class="text-caption mt-1">模板代碼：00000000_vc_medical_diagnosis_certificate</p>
                                </div>
                                <v-chip
                                    v-if="medicalIssued"
                                    color="success"
                                    variant="flat"
                                    class="ml-auto"
                                >
                                    <v-icon start>mdi-check-circle</v-icon>
                                    已領取
                                </v-chip>
                            </v-card-title>

                            <v-divider />

                            <v-card-text class="pa-6">
                                <v-form ref="form4" v-model="form4Valid">
                                    <v-row>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="medicalCert.name"
                                                label="姓名"
                                                :rules="rules.name"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="medicalCert.visit_date"
                                                label="診斷日期"
                                                :rules="rules.visit_date"
                                                variant="outlined"
                                                density="comfortable"
                                                placeholder="YYYY-MM-DD"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="medicalCert.diagnosis_category"
                                                label="診斷分類"
                                                :rules="rules.diagnosis_category"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="medicalCert.diagnosis_code"
                                                label="診斷代碼"
                                                :rules="rules.diagnosis_code"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="medicalCert.rest_start_date"
                                                label="建議休養起始日"
                                                :rules="rules.rest_start_date"
                                                variant="outlined"
                                                density="comfortable"
                                                placeholder="YYYY-MM-DD"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="medicalCert.rest_end_date"
                                                label="建議休養結束日"
                                                :rules="rules.rest_end_date"
                                                variant="outlined"
                                                density="comfortable"
                                                placeholder="YYYY-MM-DD"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="4">
                                            <v-text-field
                                                v-model="medicalCert.rest_days"
                                                label="建議休養天數"
                                                :rules="rules.rest_days"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="4">
                                            <v-text-field
                                                v-model="medicalCert.has_infectious_risk"
                                                label="是否具傳染性"
                                                :rules="rules.has_infectious_risk"
                                                variant="outlined"
                                                density="comfortable"
                                                placeholder="Yes/No"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="4">
                                            <v-text-field
                                                v-model="medicalCert.doctor_license_number"
                                                label="醫師證號"
                                                :rules="rules.doctor_license_number"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="medicalCert.hospital_name"
                                                label="醫療院所名稱"
                                                :rules="rules.hospital_name"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="medicalCert.doctor_name"
                                                label="醫師姓名"
                                                :rules="rules.doctor_name"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="medicalCert.intended_use"
                                                label="發行用途"
                                                :rules="rules.intended_use"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                        <v-col cols="12" md="6">
                                            <v-text-field
                                                v-model="medicalCert.recommendation"
                                                label="醫師建議"
                                                :rules="rules.recommendation"
                                                variant="outlined"
                                                density="comfortable"
                                                required
                                            />
                                        </v-col>
                                    </v-row>

                                    <div class="d-flex gap-3 mt-4">
                                        <v-btn
                                            color="secondary"
                                            variant="outlined"
                                            @click="generateMedicalCertDefaults"
                                            prepend-icon="mdi-auto-fix"
                                        >
                                            自動填入範例資料
                                        </v-btn>
                                        <v-btn
                                            color="primary"
                                            variant="elevated"
                                            @click="issueMedicalCert"
                                            :disabled="!form4Valid || medicalIssuing"
                                            :loading="medicalIssuing"
                                            prepend-icon="mdi-qrcode"
                                        >
                                            {{ medicalIssued ? '再次領取醫療診斷證明 VC' : '領取醫療診斷證明 VC' }}
                                        </v-btn>
                                    </div>
                                </v-form>
                            </v-card-text>
                        </v-card>
                    </v-col>
                        </v-row>

                        <!-- 前往應徵按鈕 -->
                        <v-alert
                            v-if="allVCsIssued"
                            type="success"
                            variant="tonal"
                            prominent
                            class="mt-6"
                        >
                            <v-alert-title>
                                必要 VC 已全部領取完成
                            </v-alert-title>
                            <div class="mt-2 mb-4">
                                您已成功領取身分證、學位證書及多益證書，現在可以前往應徵職位
                            </div>
                            <v-btn
                                color="success"
                                variant="elevated"
                                size="large"
                                @click="goToApply"
                                prepend-icon="mdi-briefcase-check"
                            >
                                前往應徵職位
                            </v-btn>
                        </v-alert>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>

        <!-- VC 發行對話框 -->
        <v-dialog v-model="showVCDialog" max-width="700" persistent>
            <v-card>
                <v-card-title class="text-h5 pa-4 d-flex align-center justify-space-between">
                    <span>{{ currentVCTitle }}</span>
                    <v-btn
                        icon="mdi-close"
                        variant="text"
                        size="small"
                        @click="closeVCDialog"
                    />
                </v-card-title>

                <v-card-text class="pa-6">
                    <VCQRCodeScanner
                        v-if="currentVCConfig"
                        ref="vcScanner"
                        :api-endpoint="currentVCConfig.apiEndpoint"
                        :status-endpoint="currentVCConfig.statusEndpoint"
                        :request-payload="currentVCPayload"
                        :button-text="currentVCConfig.buttonText"
                        :success-message="currentVCConfig.successMessage"
                        auto-generate
                        @success="handleVCSuccess"
                        @error="handleVCError"
                        @auto-close="closeVCDialog"
                    />
                </v-card-text>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { useRouter } from 'vue-router'
import VCQRCodeScanner from '../components/VCQRCodeScanner.vue'

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

const secureRandomElement = (array) => {
    return array[secureRandomInt(0, array.length - 1)]
}

// 表單驗證狀態
const form1Valid = ref(false)
const form2Valid = ref(false)
const form3Valid = ref(false)
const form4Valid = ref(false)

// 發行狀態
const rocDidIssuing = ref(false)
const rocDidIssued = ref(false)
const moeNdcIssuing = ref(false)
const moeNdcIssued = ref(false)
const toeicIssuing = ref(false)
const toeicIssued = ref(false)
const medicalIssuing = ref(false)
const medicalIssued = ref(false)

// 錯誤處理
const showError = ref(false)
const errorMessage = ref('')

// VC 發行對話框
const showVCDialog = ref(false)
const currentVCIndex = ref(0)
const vcScanner = ref(null)

// 表單資料
const rocDid = reactive({
    name: '',
    id_number: '',
    roc_birthday: '',
    registered_address: ''
})

const moeNdc = reactive({
    name: '',
    student_id: '',
    degree_name: '',
    degree_level: '',
    major: '',
    graduation_date: '',
    institution: ''
})

const toeicCert = reactive({
    name: '',
    candidate_id: '',
    test_name: '',
    test_date: '',
    score_listening: '',
    score_reading: '',
    score_total: '',
    institution: ''
})

const medicalCert = reactive({
    name: '',
    visit_date: '',
    diagnosis_category: '',
    diagnosis_code: '',
    rest_start_date: '',
    rest_end_date: '',
    rest_days: '',
    has_infectious_risk: '',
    hospital_name: '',
    doctor_license_number: '',
    doctor_name: '',
    recommendation: '',
    intended_use: ''
})

// VC 配置
const vcConfigs = [
    {
        title: '發行中華民國數位身分證',
        apiEndpoint: '/api/test/vc/issue',
        statusEndpoint: '/api/test/vc/status/{transactionId}',
        getPayload: () => ({
            vcUid: '00000000_roc_did_vc',
            fields: { ...rocDid }
        }),
        buttonText: '產生身分證 QR Code',
        successMessage: '身分證 VC 發行成功！',
        onSuccess: () => { rocDidIssued.value = true; rocDidIssuing.value = false }
    },
    {
        title: '發行教育部數位學位證書',
        apiEndpoint: '/api/test/vc/issue',
        statusEndpoint: '/api/test/vc/status/{transactionId}',
        getPayload: () => ({
            vcUid: '00000000_moe_ndc',
            fields: { ...moeNdc }
        }),
        buttonText: '產生學位證書 QR Code',
        successMessage: '學位證書 VC 發行成功！',
        onSuccess: () => { moeNdcIssued.value = true; moeNdcIssuing.value = false }
    },
    {
        title: '發行多益英文檢定證書',
        apiEndpoint: '/api/test/vc/issue',
        statusEndpoint: '/api/test/vc/status/{transactionId}',
        getPayload: () => ({
            vcUid: '00000000_toeic_test_cert',
            fields: { ...toeicCert }
        }),
        buttonText: '產生多益證書 QR Code',
        successMessage: '多益證書 VC 發行成功！',
        onSuccess: () => { toeicIssued.value = true; toeicIssuing.value = false }
    },
    {
        title: '發行醫療診斷證明憑證',
        apiEndpoint: '/api/test/vc/issue',
        statusEndpoint: '/api/test/vc/status/{transactionId}',
        getPayload: () => ({
            vcUid: '00000000_vc_medical_diagnosis_certificate',
            fields: { ...medicalCert }
        }),
        buttonText: '產生醫療診斷證明 QR Code',
        successMessage: '醫療診斷證明 VC 發行成功！',
        onSuccess: () => { medicalIssued.value = true; medicalIssuing.value = false }
    }
]

const currentVCConfig = computed(() => {
    return vcConfigs[currentVCIndex.value] || null
})

const currentVCTitle = computed(() => {
    return currentVCConfig.value?.title || ''
})

const currentVCPayload = computed(() => {
    return currentVCConfig.value?.getPayload() || {}
})

const allVCsIssued = computed(() => {
    return rocDidIssued.value && moeNdcIssued.value && toeicIssued.value
})

// 中華民國身分證字號驗證
const validateROCIdNumber = (idNumber) => {
    if (!/^[A-Z][12]\d{8}$/.test(idNumber)) {
        return false
    }

    const letterToNumber = {
        A: 10, B: 11, C: 12, D: 13, E: 14, F: 15, G: 16, H: 17, I: 34, J: 18,
        K: 19, L: 20, M: 21, N: 22, O: 35, P: 23, Q: 24, R: 25, S: 26, T: 27,
        U: 28, V: 29, W: 32, X: 30, Y: 31, Z: 33
    }

    const firstLetter = idNumber[0]
    const letterNum = letterToNumber[firstLetter]
    const n1 = Math.floor(letterNum / 10)
    const n2 = letterNum % 10
    const digits = idNumber.substring(1).split('').map(Number)

    const sum = n1 * 1 + n2 * 9 +
                digits[0] * 8 + digits[1] * 7 + digits[2] * 6 + digits[3] * 5 +
                digits[4] * 4 + digits[5] * 3 + digits[6] * 2 + digits[7] * 1 +
                digits[8] * 1

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
    student_id: [
        v => !!v || '學號為必填項',
        v => /^[a-zA-Z0-9]+$/.test(v) || '允許大寫字母、小寫字母以及數字'
    ],
    degree_name: [
        v => !!v || '學位名稱為必填項',
        v => /^[^~!@#$%^&*()\-+*/]+$/.test(v) || '不允許輸入~!@#$%^&*()_-+*/'
    ],
    degree_level: [
        v => !!v || '學位層級為必填項',
        v => /^[^~!@#$%^&*()\-+*/]+$/.test(v) || '不允許輸入~!@#$%^&*()_-+*/'
    ],
    major: [
        v => !!v || '主修科系為必填項',
        v => /^[^~!@#$%^&*()\-+*/]+$/.test(v) || '不允許輸入~!@#$%^&*()_-+*/'
    ],
    graduation_date: [
        v => !!v || '畢業日期為必填項',
        v => /^\d{4}-\d{2}-\d{2}$/.test(v) || '日期格式錯誤（YYYY-MM-DD）'
    ],
    institution: [
        v => !!v || '簽證單位/發證單位為必填項',
        v => /^[^~!@#$%^&*()\-+*/]+$/.test(v) || '不允許輸入~!@#$%^&*()_-+*/'
    ],
    candidate_id: [
        v => !!v || '准考證號碼為必填項',
        v => /^[a-zA-Z0-9]+$/.test(v) || '允許大寫字母、小寫字母以及數字'
    ],
    test_name: [
        v => !!v || '測驗名稱為必填項',
        v => /^[a-zA-Z0-9]+$/.test(v) || '允許大寫字母、小寫字母以及數字'
    ],
    test_date: [
        v => !!v || '測驗日期為必填項',
        v => /^\d{4}-\d{2}-\d{2}$/.test(v) || '日期格式錯誤（YYYY-MM-DD）'
    ],
    score_listening: [
        v => !!v || '聽力分數為必填項',
        v => /^\d{3}$/.test(v) || '須為3碼數字',
        v => {
            const num = parseInt(v)
            return (num >= 0 && num <= 495) || '聽力分數範圍：000-495'
        }
    ],
    score_reading: [
        v => !!v || '閱讀分數為必填項',
        v => /^\d{3}$/.test(v) || '須為3碼數字',
        v => {
            const num = parseInt(v)
            return (num >= 0 && num <= 495) || '閱讀分數範圍：000-495'
        }
    ],
    score_total: [
        v => !!v || '總分數為必填項',
        v => /^\d{3}$/.test(v) || '須為3碼數字',
        v => {
            const num = parseInt(v)
            return (num >= 0 && num <= 990) || '總分數範圍：000-990'
        }
    ],
    visit_date: [
        v => !!v || '診斷日期為必填項',
        v => /^\d{4}-\d{2}-\d{2}$/.test(v) || '日期格式錯誤（YYYY-MM-DD）'
    ],
    diagnosis_category: [
        v => !!v || '診斷分類為必填項',
        v => /^[a-zA-Z0-9_\u4e00-\u9fa5]+$/.test(v) || '只能輸入中英文數字和_'
    ],
    diagnosis_code: [
        v => !!v || '診斷代碼為必填項',
        v => /^[^~!@#$%^&*()\-+*/]+$/.test(v) || '不允許輸入~!@#$%^&*()_-+*/'
    ],
    rest_start_date: [
        v => !!v || '建議休養起始日為必填項',
        v => /^\d{4}-\d{2}-\d{2}$/.test(v) || '日期格式錯誤（YYYY-MM-DD）'
    ],
    rest_end_date: [
        v => !!v || '建議休養結束日為必填項',
        v => /^\d{4}-\d{2}-\d{2}$/.test(v) || '日期格式錯誤（YYYY-MM-DD）'
    ],
    rest_days: [
        v => !!v || '建議休養天數為必填項',
        v => /^[a-zA-Z0-9]+$/.test(v) || '允許大寫字母、小寫字母以及數字'
    ],
    has_infectious_risk: [
        v => !!v || '是否具傳染性為必填項',
        v => /^[a-zA-Z0-9]+$/.test(v) || '允許大寫字母、小寫字母以及數字'
    ],
    hospital_name: [
        v => !!v || '醫療院所名稱為必填項',
        v => /^[a-zA-Z0-9_\u4e00-\u9fa5]+$/.test(v) || '只能輸入中英文數字和_'
    ],
    doctor_license_number: [
        v => !!v || '醫師證號為必填項',
        v => /^[a-zA-Z0-9]+$/.test(v) || '允許大寫字母、小寫字母以及數字'
    ],
    doctor_name: [
        v => !!v || '醫師姓名為必填項',
        v => /^[a-zA-Z0-9_\u4e00-\u9fa5]+$/.test(v) || '只能輸入中英文數字和_'
    ],
    recommendation: [
        v => !!v || '醫師建議為必填項',
        v => /^[\u4e00-\u9fa5\s]+$/.test(v) || '只能輸入中文'
    ],
    intended_use: [
        v => !!v || '發行用途為必填項',
        v => /^[\u4e00-\u9fa5\s]+$/.test(v) || '只能輸入中文'
    ]
}

// 隨機生成合理的身分證資料
const generateRocDidDefaults = () => {
    const names = ['王小明', '陳美玲', '李志豪', '林雅婷', '張家豪', '黃淑芬']
    const cities = ['台北市', '新北市', '台中市', '台南市', '高雄市']
    const districts = ['中正區', '大安區', '信義區', '松山區', '內湖區']
    const roads = ['中山路', '民生路', '忠孝路', '仁愛路', '和平路']

    rocDid.name = secureRandomElement(names)

    // 產生合法的身分證字號
    const letters = 'ABCDEFGHJKLMNPQRSTUVXYWZIO'
    const letterToNumber = {
        A: 10, B: 11, C: 12, D: 13, E: 14, F: 15, G: 16, H: 17, I: 34, J: 18,
        K: 19, L: 20, M: 21, N: 22, O: 35, P: 23, Q: 24, R: 25, S: 26, T: 27,
        U: 28, V: 29, W: 32, X: 30, Y: 31, Z: 33
    }

    const firstLetter = letters[secureRandomInt(0, letters.length - 1)]
    const gender = secureRandom() > 0.5 ? '1' : '2'

    const letterNum = letterToNumber[firstLetter]
    const n1 = Math.floor(letterNum / 10)
    const n2 = letterNum % 10

    const digits = []
    digits.push(parseInt(gender))
    for (let i = 0; i < 7; i++) {
        digits.push(secureRandomInt(0, 9))
    }

    const sum = n1 * 1 + n2 * 9 +
                digits[0] * 8 + digits[1] * 7 + digits[2] * 6 + digits[3] * 5 +
                digits[4] * 4 + digits[5] * 3 + digits[6] * 2 + digits[7] * 1

    const checkDigit = (10 - (sum % 10)) % 10

    rocDid.id_number = firstLetter + digits.join('') + checkDigit

    const year = secureRandomInt(70, 89)
    const month = secureRandomInt(1, 12)
    const day = secureRandomInt(1, 28)
    rocDid.roc_birthday = year.toString().padStart(3, '0') +
                          month.toString().padStart(2, '0') +
                          day.toString().padStart(2, '0')

    const city = secureRandomElement(cities)
    const district = secureRandomElement(districts)
    const road = secureRandomElement(roads)
    const number = secureRandomInt(1, 500)
    rocDid.registered_address = `${city}${district}${road}${number}號`
}

// 隨機生成合理的學位證書資料
const generateMoeNdcDefaults = () => {
    const universities = ['國立臺灣大學', '國立清華大學', '國立交通大學', '國立成功大學', '國立政治大學']
    const majors = ['資訊工程學系', '電機工程學系', '企業管理學系', '財務金融學系', '法律學系']
    const degrees = ['學士', '碩士']
    const levels = ['大學', '研究所']

    moeNdc.name = rocDid.name || '王小明'

    const studentIdPrefix = secureRandomElement(['B', 'M', 'D'])
    const studentIdNumber = secureRandomInt(0, 99999999).toString().padStart(8, '0')
    moeNdc.student_id = studentIdPrefix + studentIdNumber

    const degreeIndex = secureRandomInt(0, degrees.length - 1)
    moeNdc.degree_name = degrees[degreeIndex]
    moeNdc.degree_level = levels[degreeIndex]

    moeNdc.major = secureRandomElement(majors)

    const year = secureRandomInt(2019, 2024)
    const month = secureRandom() > 0.5 ? '06' : '01'
    const day = secureRandom() > 0.5 ? '15' : '20'
    moeNdc.graduation_date = `${year}-${month}-${day}`

    moeNdc.institution = secureRandomElement(universities)
}

// 隨機生成合理的多益證書資料
const generateToeicCertDefaults = () => {
    toeicCert.name = rocDid.name || '王小明'

    const candidateIdPrefix = secureRandomElement(['A', 'B', 'C'])
    const candidateIdNumber = secureRandomInt(0, 99999999).toString().padStart(8, '0')
    toeicCert.candidate_id = candidateIdPrefix + candidateIdNumber

    toeicCert.test_name = 'TOEIC'

    const year = secureRandom() > 0.5 ? 2023 : 2024
    const month = secureRandomInt(1, 12)
    const day = secureRandomInt(1, 28)
    toeicCert.test_date = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`

    const listeningScore = secureRandomInt(200, 450)
    toeicCert.score_listening = listeningScore.toString().padStart(3, '0')

    const readingScore = secureRandomInt(200, 450)
    toeicCert.score_reading = readingScore.toString().padStart(3, '0')

    const totalScore = listeningScore + readingScore
    toeicCert.score_total = totalScore.toString().padStart(3, '0')

    toeicCert.institution = '財團法人語言訓練測驗中心'
}

// 隨機生成合理的醫療診斷證明資料
const generateMedicalCertDefaults = () => {
    // 姓名必須與身分證資料一致
    medicalCert.name = rocDid.name || '王小明'

    // 診斷日期為今天
    const today = new Date()
    medicalCert.visit_date = today.toISOString().split('T')[0]

    // ICD-10 特殊疾病診斷（難以啟齒或心理疾病）
    const diagnoses = [
        { category: '廣泛性焦慮症', code: 'F411', infectious: 'No', recommendation: '建議充分休息避免壓力' },
        { category: '重度憂鬱症發作', code: 'F329', infectious: 'No', recommendation: '需完全休息遠離工作' },
        { category: '恐慌症發作', code: 'F410', infectious: 'No', recommendation: '建議在家休養穩定情緒' },
        { category: '急性壓力反應', code: 'F431', infectious: 'No', recommendation: '遠離壓力源多休息' },
        { category: '創傷後壓力症候群', code: 'F431', infectious: 'No', recommendation: '需要安靜環境療養' },
        { category: '社交恐懼症', code: 'F401', infectious: 'No', recommendation: '暫時減少社交在家休養' },
        { category: '適應障礙伴焦慮', code: 'F432', infectious: 'No', recommendation: '充分休息調適心情' },
        { category: '強迫症', code: 'F42', infectious: 'No', recommendation: '在家休養練習放鬆' },
        { category: '特定畏懼症', code: 'F408', infectious: 'No', recommendation: '暫時避開恐懼對象休養' },
        { category: '自律神經失調', code: 'G90', infectious: 'No', recommendation: '規律作息避免熬夜' },
        { category: '失眠症', code: 'G470', infectious: 'No', recommendation: '建立規律睡眠作息' },
        { category: '偏頭痛', code: 'G43', infectious: 'No', recommendation: '安靜環境休息避免刺激' },
        { category: '慢性疲勞症候群', code: 'G933', infectious: 'No', recommendation: '充分休息避免過勞' },
        { category: '腸躁症', code: 'K589', infectious: 'No', recommendation: '清淡飲食減少壓力' },
        { category: '痔瘡', code: 'K64', infectious: 'No', recommendation: '溫水坐浴避免久坐' }
    ]

    const selectedDiagnosis = secureRandomElement(diagnoses)
    medicalCert.diagnosis_category = selectedDiagnosis.category
    medicalCert.diagnosis_code = selectedDiagnosis.code
    medicalCert.has_infectious_risk = selectedDiagnosis.infectious
    medicalCert.recommendation = selectedDiagnosis.recommendation

    // 隨機產生 3-7 天的休養天數
    const restDays = secureRandomInt(3, 7)
    medicalCert.rest_days = restDays.toString()

    // 建議休養起始日為今天
    medicalCert.rest_start_date = medicalCert.visit_date

    // 建議休養結束日 = 起始日 + 休養天數
    const restEnd = new Date(today)
    restEnd.setDate(restEnd.getDate() + restDays)
    medicalCert.rest_end_date = restEnd.toISOString().split('T')[0]

    // 醫療院所名稱
    const hospitals = ['台大醫院', '榮民總醫院', '長庚紀念醫院', '馬偕紀念醫院', '中國醫藥大學附設醫院', '國泰綜合醫院', '新光吳火獅紀念醫院']
    medicalCert.hospital_name = secureRandomElement(hospitals)

    // 醫師姓名
    const doctorLastNames = ['王', '李', '張', '陳', '林', '黃', '吳', '劉', '蔡', '楊']
    const doctorFirstNames = ['志明', '建國', '雅婷', '怡君', '俊傑', '淑芬', '家豪', '美玲', '承翰', '詩涵']
    medicalCert.doctor_name = secureRandomElement(doctorLastNames) +
                               secureRandomElement(doctorFirstNames)

    // 醫師證號
    const licenseNumber = secureRandomInt(0, 99999).toString().padStart(6, '0')
    medicalCert.doctor_license_number = 'MD' + licenseNumber

    // 發行用途一律為公司請假
    medicalCert.intended_use = '公司請假'
}

// 發行 VC
const issueRocDid = () => {
    if (rocDidIssued.value) {
        errorMessage.value = '您已經領取過中華民國數位身分證，無法重複領取'
        showError.value = true
        return
    }
    rocDidIssuing.value = true
    currentVCIndex.value = 0
    showVCDialog.value = true
}

const issueMoeNdc = () => {
    if (moeNdcIssued.value) {
        errorMessage.value = '您已經領取過教育部數位學位證書，無法重複領取'
        showError.value = true
        return
    }
    moeNdcIssuing.value = true
    currentVCIndex.value = 1
    showVCDialog.value = true
}

const issueToeicCert = () => {
    if (toeicIssued.value) {
        errorMessage.value = '您已經領取過多益證書，無法重複領取'
        showError.value = true
        return
    }
    toeicIssuing.value = true
    currentVCIndex.value = 2
    showVCDialog.value = true
}

const issueMedicalCert = () => {
    medicalIssuing.value = true
    currentVCIndex.value = 3
    showVCDialog.value = true
}

// 處理 VC 發行成功
const handleVCSuccess = ({ cid, transactionId }) => {
    // 不自動關閉對話框，讓用戶看到成功訊息後手動關閉
    // showVCDialog.value = false

    // 呼叫對應的 onSuccess 回調
    if (currentVCConfig.value?.onSuccess) {
        currentVCConfig.value.onSuccess()
    }
}

// 處理 VC 發行錯誤
const handleVCError = (error) => {
    errorMessage.value = `${currentVCConfig.value?.title || 'VC'} 發行失敗：${error}`
    showError.value = true
    showVCDialog.value = false

    // 重置對應的發行狀態
    if (currentVCIndex.value === 0) rocDidIssuing.value = false
    if (currentVCIndex.value === 1) moeNdcIssuing.value = false
    if (currentVCIndex.value === 2) toeicIssuing.value = false
    if (currentVCIndex.value === 3) medicalIssuing.value = false
}

// 關閉 VC 對話框
const closeVCDialog = () => {
    // 停止 polling 和倒數計時
    vcScanner.value?.reset()

    showVCDialog.value = false

    // 重置對應的發行狀態
    if (currentVCIndex.value === 0) rocDidIssuing.value = false
    if (currentVCIndex.value === 1) moeNdcIssuing.value = false
    if (currentVCIndex.value === 2) toeicIssuing.value = false
    if (currentVCIndex.value === 3) medicalIssuing.value = false
}

// 導航
const goBack = () => {
    router.push({ name: 'Home' })
}

const goToApply = () => {
    router.push({ name: 'Apply' })
}
</script>

<style scoped>
.prerequisite-vc-page {
    min-height: 100vh;
    padding: 40px 20px;
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
}

.main-card {
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12) !important;
    transition: all 0.3s ease;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 24px !important;
    display: flex;
    align-items: center;
}

.vc-card {
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08) !important;
    transition: transform 0.2s, box-shadow 0.2s;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.vc-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12) !important;
}

.vc-card .card-header {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    color: inherit;
    padding: 20px 24px !important;
    display: flex;
    align-items: center;
}

.gap-3 {
    gap: 12px;
}

/* 響應式設計 */
@media (max-width: 600px) {
    .prerequisite-vc-page {
        padding: 20px 10px;
    }

    .card-header {
        padding: 16px !important;
        flex-wrap: wrap;
    }
}
</style>
