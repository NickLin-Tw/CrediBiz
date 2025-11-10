# CrediBiz 可重用元件

本目錄包含可重用的 Vue 元件，用於簡化 TW-DIW 數位憑證的整合。

## VCQRCodeScanner.vue

用於 **VC (Verifiable Credential) 發行流程**，當你需要讓使用者領取（掃描）數位憑證時使用。

### 使用場景
- 發行員工證明 VC
- 發行任何自訂的 VC
- 需要使用者掃描 QR Code 領取憑證的場景

### Props

| 名稱 | 類型 | 必填 | 預設值 | 說明 |
|------|------|------|--------|------|
| `apiEndpoint` | String | 是 | - | 產生 QR Code 的 API endpoint |
| `statusEndpoint` | String | 是 | - | 查詢發行狀態的 API endpoint，使用 `{transactionId}` 作為佔位符 |
| `requestPayload` | Object | 否 | `{}` | 發送給 API 的請求內容 |
| `buttonText` | String | 否 | `'產生領取 QR Code'` | 初始按鈕文字 |
| `successMessage` | String | 否 | `'您的數位憑證已成功發行'` | 成功訊息 |
| `showInitialButton` | Boolean | 否 | `true` | 是否顯示初始產生按鈕 |
| `autoGenerate` | Boolean | 否 | `false` | 是否在 mount 時自動產生 QR Code |
| `pollingInterval` | Number | 否 | `3000` | 輪詢間隔（毫秒） |
| `timeout` | Number | 否 | `180` | QR Code 有效時間（秒） |

### Events

| 事件名稱 | 參數 | 說明 |
|---------|------|------|
| `generated` | `{ transactionId, data }` | QR Code 產生成功時觸發 |
| `success` | `{ cid, transactionId, data }` | 使用者成功領取憑證時觸發 |
| `error` | `errorMessage` | 發生錯誤時觸發 |

### Exposed Methods

| 方法名稱 | 說明 |
|---------|------|
| `generate()` | 手動產生 QR Code |
| `regenerate()` | 重新產生 QR Code |
| `reset()` | 重置元件狀態 |

### 使用範例

```vue
<template>
    <div>
        <h1>領取員工數位憑證</h1>

        <VCQRCodeScanner
            api-endpoint="/api/employee-credentials/issue"
            status-endpoint="/api/test/vc/status/{transactionId}"
            :request-payload="{ employee_id: employeeId }"
            button-text="產生員工憑證 QR Code"
            success-message="您的員工憑證已成功發行！"
            @success="handleSuccess"
            @error="handleError"
        />
    </div>
</template>

<script setup>
import VCQRCodeScanner from '@/components/VCQRCodeScanner.vue'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const employeeId = ref('000001')

const handleSuccess = ({ cid, transactionId }) => {
    console.log('成功領取憑證！CID:', cid)
    // 導向下一個頁面或顯示成功訊息
    router.push({ name: 'Dashboard' })
}

const handleError = (errorMessage) => {
    alert('發生錯誤：' + errorMessage)
}
</script>
```

---

## VPQRCodeScanner.vue

用於 **VP (Verifiable Presentation) 驗證流程**，當你需要使用者提供數位憑證進行驗證時使用。

### 使用場景
- 應徵職位時驗證政府發行的 VC（身分證、學位、英檢證書）
- 員工登入系統時驗證員工證明 VC
- 任何需要使用者出示憑證的場景

### Props

| 名稱 | 類型 | 必填 | 預設值 | 說明 |
|------|------|------|--------|------|
| `vpRef` | String | 是 | - | VP 驗證參考碼（例如：`00000000_vp_recruitment`） |
| `successMessage` | String | 否 | `'已成功驗證您的數位憑證'` | 驗證成功訊息 |
| `autoStart` | Boolean | 否 | `false` | 是否在 mount 時自動開始驗證 |
| `pollingInterval` | Number | 否 | `3000` | 輪詢間隔（毫秒） |
| `timeout` | Number | 否 | `180` | QR Code 有效時間（秒） |
| `dialog` | Boolean | 否 | `false` | 是否在對話框中顯示（保留供未來使用） |

### Events

| 事件名稱 | 參數 | 說明 |
|---------|------|------|
| `generated` | `{ transactionId, data }` | QR Code 產生成功時觸發 |
| `success` | `{ transactionId, vpData, fullResponse }` | 驗證成功時觸發 |
| `error` | `errorMessage` | 發生錯誤時觸發 |
| `cancel` | - | 使用者取消驗證時觸發 |

### Exposed Methods

| 方法名稱 | 說明 |
|---------|------|
| `start()` | 開始驗證流程 |
| `regenerate()` | 重新產生 QR Code |
| `reset()` | 重置元件狀態 |
| `cancel()` | 取消驗證 |
| `getTransactionId()` | 取得當前 transaction ID |
| `isVerified()` | 檢查是否已驗證 |

### 使用範例

#### 範例 1：應徵職位驗證

```vue
<template>
    <div>
        <h1>應徵職位</h1>

        <v-btn @click="showDialog = true">
            從憑證自動匯入資料
        </v-btn>

        <v-dialog v-model="showDialog" max-width="700" persistent>
            <v-card>
                <v-card-title>
                    掃描 QR Code 驗證身份
                    <v-btn
                        icon="mdi-close"
                        @click="closeDialog"
                        class="float-right"
                    />
                </v-card-title>

                <v-card-text>
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

        <v-form v-if="vpTransactionId">
            <!-- 表單欄位 -->
            <v-text-field v-model="formData.name" label="姓名" readonly />
            <!-- ... 其他欄位 ... -->

            <v-btn @click="submitApplication">提交申請</v-btn>
        </v-form>
    </div>
</template>

<script setup>
import VPQRCodeScanner from '@/components/VPQRCodeScanner.vue'
import { ref } from 'vue'

const showDialog = ref(false)
const vpScanner = ref(null)
const vpTransactionId = ref(null)
const formData = ref({
    name: '',
    id_number: '',
    // ... 其他欄位
})

const handleVPSuccess = ({ transactionId, vpData }) => {
    // 儲存 transaction ID（用於後端驗證）
    vpTransactionId.value = transactionId

    // 從 vpData 提取資料填入表單（僅用於顯示）
    vpData.forEach(vc => {
        vc.claims.forEach(claim => {
            if (claim.ename in formData.value) {
                formData.value[claim.ename] = claim.value
            }
        })
    })

    showDialog.value = false
}

const handleVPError = (errorMessage) => {
    alert('驗證失敗：' + errorMessage)
}

const closeDialog = () => {
    vpScanner.value?.cancel()
    showDialog.value = false
}

const submitApplication = async () => {
    // 重要：只傳送 transaction ID，由後端去取得真實資料
    await fetch('/api/applications', {
        method: 'POST',
        body: JSON.stringify({
            vp_transaction_id: vpTransactionId.value
        })
    })
}
</script>
```

#### 範例 2：員工登入

```vue
<template>
    <div>
        <h1>員工登入</h1>

        <VPQRCodeScanner
            vp-ref="00000000_vp_employee_login"
            success-message="登入成功！正在跳轉..."
            @success="handleLoginSuccess"
            @error="handleLoginError"
        />
    </div>
</template>

<script setup>
import VPQRCodeScanner from '@/components/VPQRCodeScanner.vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const handleLoginSuccess = async ({ transactionId }) => {
    // 呼叫登入 API
    const response = await fetch('/api/auth/login', {
        method: 'POST',
        body: JSON.stringify({
            vp_transaction_id: transactionId
        })
    })

    const data = await response.json()

    if (data.success) {
        // 儲存登入狀態
        localStorage.setItem('employee_id', data.employee.employee_id)
        localStorage.setItem('logged_in', 'true')

        // 跳轉到 Dashboard
        router.push({ name: 'Dashboard' })
    }
}

const handleLoginError = (errorMessage) => {
    alert('登入失敗：' + errorMessage)
}
</script>
```

---

## 設計原則

1. **關注點分離**：UI 邏輯（倒數計時、QR Code 顯示）與業務邏輯（API 呼叫、資料處理）分離

2. **可重用性**：透過 props 和 events 讓元件可以適用於不同場景

3. **安全性**：
   - VP 驗證只傳送 transaction ID 給父元件
   - 真實資料由後端從 TW-DIW API 取得
   - 避免前端資料被竄改

4. **使用者體驗**：
   - 3 分鐘倒數計時
   - 視覺化警告（橘色/紅色）
   - Deep Link 快速開啟
   - 清楚的使用說明

5. **自動化**：
   - 自動輪詢狀態（每 3 秒）
   - 自動清除計時器
   - 可選的自動開始功能

## 注意事項

- 確保後端 API endpoints 已正確設定
- VC 的 `statusEndpoint` 必須包含 `{transactionId}` 佔位符
- VP 的驗證結果必須在後端處理，不要信任前端傳來的資料
- 記得在使用元件的頁面導入元件

## 未來擴充建議

1. 支援自訂 UI 樣式
2. 支援多語言
3. 支援錯誤重試機制
4. 支援離線模式提示
5. 加入單元測試
