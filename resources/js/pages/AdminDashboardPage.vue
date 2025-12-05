<template>
    <v-app>
        <v-app-bar color="primary" elevation="2">
            <v-app-bar-title class="text-h5 font-weight-bold">
                <v-icon class="mr-2">mdi-shield-crown</v-icon>
                CrediBiz 管理後台
            </v-app-bar-title>
            <v-spacer />
            <v-btn icon="mdi-home" @click="$router.push({ name: 'Home' })" />
        </v-app-bar>

        <v-main class="bg-gradient">
            <v-container fluid class="pa-6">
                <v-row>
                    <!-- 統計卡片 -->
                    <v-col cols="12" md="3">
                        <v-card elevation="4" rounded="lg">
                            <v-card-text class="text-center">
                                <v-icon size="48" color="primary">mdi-account-group</v-icon>
                                <div class="text-h4 mt-2">{{ stats.totalEmployees }}</div>
                                <div class="text-caption text-medium-emphasis">員工總數</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-card elevation="4" rounded="lg">
                            <v-card-text class="text-center">
                                <v-icon size="48" color="success">mdi-certificate</v-icon>
                                <div class="text-h4 mt-2">{{ stats.totalVCIssued }}</div>
                                <div class="text-caption text-medium-emphasis">憑證發行數</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-card elevation="4" rounded="lg">
                            <v-card-text class="text-center">
                                <v-icon size="48" color="info">mdi-login</v-icon>
                                <div class="text-h4 mt-2">{{ stats.totalLogins }}</div>
                                <div class="text-caption text-medium-emphasis">登入次數</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-card elevation="4" rounded="lg">
                            <v-card-text class="text-center">
                                <v-icon size="48" color="warning">mdi-shield-check</v-icon>
                                <div class="text-h4 mt-2">{{ stats.totalVPVerifications }}</div>
                                <div class="text-caption text-medium-emphasis">VP 驗證次數</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>

                <v-row class="mt-3">
                    <v-col cols="12" md="3">
                        <v-card elevation="4" rounded="lg">
                            <v-card-text class="text-center">
                                <v-icon size="48" color="deep-purple">mdi-medical-bag</v-icon>
                                <div class="text-h4 mt-2">{{ stats.totalMedicalLeaves }}</div>
                                <div class="text-caption text-medium-emphasis">病假申請數</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>

                <!-- 快速導航 -->
                <v-row class="mt-4">
                    <v-col cols="12">
                        <v-card elevation="3" rounded="lg" color="blue-grey-lighten-5">
                            <v-card-title class="text-h6">
                                <v-icon class="mr-2">mdi-rocket-launch</v-icon>
                                快速導航
                            </v-card-title>
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12" md="4">
                                        <v-btn
                                            block
                                            size="large"
                                            color="primary"
                                            variant="elevated"
                                            @click="$router.push({ name: 'AdminEmployees' })"
                                        >
                                            <v-icon start>mdi-account-group</v-icon>
                                            員工管理
                                        </v-btn>
                                    </v-col>
                                    <v-col cols="12" md="4">
                                        <v-btn
                                            block
                                            size="large"
                                            color="deep-purple"
                                            variant="elevated"
                                            @click="$router.push({ name: 'AdminMedicalLeaves' })"
                                        >
                                            <v-icon start>mdi-medical-bag</v-icon>
                                            病假審核
                                        </v-btn>
                                    </v-col>
                                    <v-col cols="12" md="4">
                                        <v-btn
                                            block
                                            size="large"
                                            color="orange"
                                            variant="elevated"
                                            @click="$router.push({ name: 'AdminApiLogs' })"
                                        >
                                            <v-icon start>mdi-api</v-icon>
                                            API Logs
                                        </v-btn>
                                    </v-col>
                                    <v-col cols="12" md="4">
                                        <v-btn
                                            block
                                            size="large"
                                            color="teal"
                                            variant="elevated"
                                            @click="$router.push({ name: 'AdminVisitorParking' })"
                                        >
                                            <v-icon start>mdi-car-parking-lights</v-icon>
                                            訪客停車證審核
                                        </v-btn>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>

                <!-- Tab 選單 -->
                <v-card class="mt-6" elevation="4" rounded="lg">
                    <v-tabs v-model="currentTab" bg-color="primary">
                        <v-tab value="employees">
                            <v-icon start>mdi-account-group</v-icon>
                            員工管理
                        </v-tab>
                        <v-tab value="login-logs">
                            <v-icon start>mdi-login</v-icon>
                            登入記錄
                        </v-tab>
                        <v-tab value="vc-logs">
                            <v-icon start>mdi-certificate</v-icon>
                            VC 發行記錄
                        </v-tab>
                        <v-tab value="vp-logs">
                            <v-icon start>mdi-shield-check</v-icon>
                            VP 驗證記錄
                        </v-tab>
                        <v-tab value="vc-status-logs">
                            <v-icon start>mdi-file-document-edit</v-icon>
                            VC 狀態變更記錄
                        </v-tab>
                        <v-tab value="medical-leaves">
                            <v-icon start>mdi-medical-bag</v-icon>
                            病假申請記錄
                        </v-tab>
                        <v-tab value="medical-leave-vp-logs">
                            <v-icon start>mdi-shield-account</v-icon>
                            病假 VP 驗證記錄
                        </v-tab>
                        <v-tab value="activity-logs">
                            <v-icon start>mdi-history</v-icon>
                            活動日誌
                        </v-tab>
                    </v-tabs>

                    <v-card-text>
                        <v-window v-model="currentTab">
                            <!-- 員工管理 -->
                            <v-window-item value="employees">
                                <v-text-field
                                    v-model="employeeSearch"
                                    label="搜尋員工（編號、姓名、部門）"
                                    prepend-inner-icon="mdi-magnify"
                                    variant="outlined"
                                    density="compact"
                                    class="mb-4"
                                    @input="searchEmployees"
                                />

                                <v-data-table
                                    :headers="employeeHeaders"
                                    :items="employees"
                                    :loading="employeesLoading"
                                    :items-per-page="20"
                                    class="elevation-1"
                                >
                                    <template #[`item.employee_vc_cid`]="{ item }">
                                        <v-chip
                                            :color="item.employee_vc_cid ? 'success' : 'grey'"
                                            size="small"
                                        >
                                            {{ item.employee_vc_cid ? '已發行' : '未發行' }}
                                        </v-chip>
                                    </template>
                                    <template #[`item.employee_vc_expiry_date`]="{ item }">
                                        {{ item.employee_vc_expiry_date || '-' }}
                                    </template>
                                    <template #[`item.actions`]="{ item }">
                                        <v-btn
                                            v-if="item.employee_vc_cid"
                                            size="small"
                                            color="error"
                                            variant="outlined"
                                            @click="openRevokeDialog(item)"
                                            class="mr-2"
                                        >
                                            撤銷憑證
                                        </v-btn>
                                        <v-btn
                                            size="small"
                                            color="primary"
                                            variant="outlined"
                                            @click="openReissueDialog(item)"
                                        >
                                            {{ item.employee_vc_cid ? '換發憑證' : '發行憑證' }}
                                        </v-btn>
                                    </template>
                                </v-data-table>
                            </v-window-item>

                            <!-- 登入記錄 -->
                            <v-window-item value="login-logs">
                                <v-data-table
                                    :headers="loginLogHeaders"
                                    :items="loginLogs"
                                    :loading="loginLogsLoading"
                                    :items-per-page="20"
                                    class="elevation-1"
                                >
                                    <template #[`item.created_at`]="{ item }">
                                        {{ formatDateTime(item.created_at) }}
                                    </template>
                                </v-data-table>
                            </v-window-item>

                            <!-- VC 發行記錄 -->
                            <v-window-item value="vc-logs">
                                <v-data-table
                                    :headers="vcLogHeaders"
                                    :items="vcLogs"
                                    :loading="vcLogsLoading"
                                    :items-per-page="20"
                                    class="elevation-1"
                                >
                                    <template #[`item.vc_cid`]="{ item }">
                                        <code class="text-caption">{{ item.vc_cid }}</code>
                                    </template>
                                    <template #[`item.created_at`]="{ item }">
                                        {{ formatDateTime(item.created_at) }}
                                    </template>
                                </v-data-table>
                            </v-window-item>

                            <!-- VP 驗證記錄 -->
                            <v-window-item value="vp-logs">
                                <v-data-table
                                    :headers="vpLogHeaders"
                                    :items="vpLogs"
                                    :loading="vpLogsLoading"
                                    :items-per-page="20"
                                    class="elevation-1"
                                >
                                    <template #[`item.verify_result`]="{ item }">
                                        <v-chip
                                            :color="item.verify_result === 'success' ? 'success' : 'error'"
                                            size="small"
                                        >
                                            {{ item.verify_result }}
                                        </v-chip>
                                    </template>
                                    <template #[`item.created_at`]="{ item }">
                                        {{ formatDateTime(item.created_at) }}
                                    </template>
                                </v-data-table>
                            </v-window-item>

                            <!-- VC 狀態變更記錄 -->
                            <v-window-item value="vc-status-logs">
                                <v-data-table
                                    :headers="vcStatusLogHeaders"
                                    :items="vcStatusLogs"
                                    :loading="vcStatusLogsLoading"
                                    :items-per-page="20"
                                    class="elevation-1"
                                >
                                    <template #[`item.action`]="{ item }">
                                        <v-chip
                                            :color="getActionColor(item.action)"
                                            size="small"
                                        >
                                            {{ item.action }}
                                        </v-chip>
                                    </template>
                                    <template #[`item.created_at`]="{ item }">
                                        {{ formatDateTime(item.created_at) }}
                                    </template>
                                </v-data-table>
                            </v-window-item>

                            <!-- 病假申請記錄 -->
                            <v-window-item value="medical-leaves">
                                <v-data-table
                                    :headers="medicalLeaveHeaders"
                                    :items="medicalLeaves"
                                    :loading="medicalLeavesLoading"
                                    :items-per-page="20"
                                    class="elevation-1"
                                >
                                    <template #[`item.leave_days`]="{ item }">
                                        <v-chip color="info" size="small">
                                            {{ item.leave_days }} 天
                                        </v-chip>
                                    </template>
                                    <template #[`item.created_at`]="{ item }">
                                        {{ formatDateTime(item.created_at) }}
                                    </template>
                                </v-data-table>
                            </v-window-item>

                            <!-- 病假 VP 驗證記錄 -->
                            <v-window-item value="medical-leave-vp-logs">
                                <v-data-table
                                    :headers="medicalLeaveVPLogHeaders"
                                    :items="medicalLeaveVPLogs"
                                    :loading="medicalLeaveVPLogsLoading"
                                    :items-per-page="20"
                                    class="elevation-1"
                                >
                                    <template #[`item.verify_result`]="{ item }">
                                        <v-chip
                                            :color="item.verify_result === 'success' ? 'success' : 'error'"
                                            size="small"
                                        >
                                            {{ item.verify_result }}
                                        </v-chip>
                                    </template>
                                    <template #[`item.rejection_reason`]="{ item }">
                                        <span v-if="item.rejection_reason" class="text-error">
                                            {{ item.rejection_reason }}
                                        </span>
                                        <span v-else class="text-success">-</span>
                                    </template>
                                    <template #[`item.verified_at`]="{ item }">
                                        {{ formatDateTime(item.verified_at) }}
                                    </template>
                                </v-data-table>
                            </v-window-item>

                            <!-- 活動日誌 -->
                            <v-window-item value="activity-logs">
                                <!-- 篩選器 -->
                                <v-row class="mb-4">
                                    <v-col cols="12" md="3">
                                        <v-select
                                            v-model="activityLogFilters.action"
                                            :items="actionTypes"
                                            label="行為類型"
                                            clearable
                                            variant="outlined"
                                            density="compact"
                                            @update:model-value="loadActivityLogs"
                                        />
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <v-select
                                            v-model="activityLogFilters.status"
                                            :items="statusTypes"
                                            label="狀態"
                                            clearable
                                            variant="outlined"
                                            density="compact"
                                            @update:model-value="loadActivityLogs"
                                        />
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <v-text-field
                                            v-model="activityLogFilters.employee_id"
                                            label="員工編號"
                                            clearable
                                            variant="outlined"
                                            density="compact"
                                            @keyup.enter="loadActivityLogs"
                                        />
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <v-btn color="primary" @click="loadActivityLogs" block>
                                            <v-icon start>mdi-filter</v-icon>
                                            篩選
                                        </v-btn>
                                    </v-col>
                                </v-row>

                                <!-- 統計卡片 -->
                                <v-row class="mb-4" v-if="activityStats">
                                    <v-col cols="12" md="3" v-for="stat in activityStats.action_stats.slice(0, 4)" :key="stat.action">
                                        <v-card elevation="2">
                                            <v-card-text class="text-center">
                                                <div class="text-h6">{{ stat.count }}</div>
                                                <div class="text-caption text-medium-emphasis">{{ stat.action_display }}</div>
                                            </v-card-text>
                                        </v-card>
                                    </v-col>
                                </v-row>

                                <v-data-table
                                    :headers="activityLogHeaders"
                                    :items="activityLogs"
                                    :loading="activityLogsLoading"
                                    :items-per-page="50"
                                    class="elevation-1"
                                >
                                    <template #[`item.action_display`]="{ item }">
                                        <v-chip size="small" color="primary" variant="tonal">
                                            {{ item.action_display }}
                                        </v-chip>
                                    </template>
                                    <template #[`item.status`]="{ item }">
                                        <v-chip
                                            :color="item.status === 'success' ? 'success' : 'error'"
                                            size="small"
                                        >
                                            {{ item.status }}
                                        </v-chip>
                                    </template>
                                    <template #[`item.actor_type`]="{ item }">
                                        <v-chip
                                            :color="getActorTypeColor(item.actor_type)"
                                            size="small"
                                            variant="tonal"
                                        >
                                            {{ item.actor_type }}
                                        </v-chip>
                                    </template>
                                    <template #[`item.created_at`]="{ item }">
                                        {{ formatDateTime(item.created_at) }}
                                    </template>
                                </v-data-table>
                            </v-window-item>
                        </v-window>
                    </v-card-text>
                </v-card>
            </v-container>
        </v-main>

        <!-- 撤銷憑證對話框 -->
        <v-dialog v-model="showRevokeDialog" max-width="500">
            <v-card>
                <v-card-title>撤銷員工憑證</v-card-title>
                <v-card-text>
                    <v-alert type="warning" variant="tonal" class="mb-4">
                        此操作將撤銷 {{ selectedEmployee?.name }} ({{ selectedEmployee?.employee_id }}) 的員工憑證，且無法復原。
                    </v-alert>
                    <v-textarea
                        v-model="revokeReason"
                        label="撤銷原因"
                        variant="outlined"
                        rows="3"
                        required
                    />
                </v-card-text>
                <v-card-actions>
                    <v-spacer />
                    <v-btn variant="text" @click="showRevokeDialog = false">取消</v-btn>
                    <v-btn color="error" :loading="revokeLoading" @click="confirmRevoke">確認撤銷</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- 發行/換發憑證對話框 -->
        <v-dialog v-model="showReissueDialog" max-width="600">
            <v-card>
                <v-card-title>
                    {{ selectedEmployee?.employee_vc_cid ? '換發' : '發行' }}員工憑證
                </v-card-title>
                <v-card-text>
                    <div v-if="reissueStep === 1">
                        <v-alert type="info" variant="tonal" class="mb-4">
                            即將為 {{ selectedEmployee?.name }} ({{ selectedEmployee?.employee_id }}) {{ selectedEmployee?.employee_vc_cid ? '換發' : '發行' }}員工憑證
                        </v-alert>
                        <v-btn
                            color="primary"
                            block
                            :loading="reissueLoading"
                            @click="startReissue"
                        >
                            開始{{ selectedEmployee?.employee_vc_cid ? '換發' : '發行' }}
                        </v-btn>
                    </div>
                    <div v-else-if="reissueStep === 2">
                        <VCQRCodeScanner
                            ref="reissueScanner"
                            status-endpoint="/api/test/vc/status/{transactionId}"
                            :auto-generate="true"
                            :pre-generated-data="reissueQRData"
                            success-message="憑證領取成功！"
                            @success="handleReissueSuccess"
                        />
                    </div>
                    <div v-else-if="reissueStep === 3">
                        <v-alert type="success" variant="tonal">
                            <v-alert-title>憑證{{ selectedEmployee?.employee_vc_cid ? '換發' : '發行' }}成功</v-alert-title>
                            憑證已成功{{ selectedEmployee?.employee_vc_cid ? '換發' : '發行' }}
                        </v-alert>
                    </div>
                </v-card-text>
                <v-card-actions>
                    <v-spacer />
                    <v-btn variant="text" @click="closeReissueDialog">關閉</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-app>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import VCQRCodeScanner from '@/components/VCQRCodeScanner.vue'

const currentTab = ref('employees')

// 統計資料
const stats = ref({
    totalEmployees: 0,
    totalVCIssued: 0,
    totalLogins: 0,
    totalVPVerifications: 0,
    totalMedicalLeaves: 0
})

// 員工管理
const employeeSearch = ref('')
const employees = ref([])
const employeesLoading = ref(false)
const employeeHeaders = [
    { title: '員工編號', key: 'employee_id', sortable: true },
    { title: '姓名', key: 'name', sortable: true },
    { title: '部門', key: 'department', sortable: true },
    { title: '職位', key: 'position', sortable: true },
    { title: '憑證狀態', key: 'employee_vc_cid', sortable: false },
    { title: '憑證到期日', key: 'employee_vc_expiry_date', sortable: true },
    { title: '操作', key: 'actions', sortable: false }
]

// 登入記錄
const loginLogs = ref([])
const loginLogsLoading = ref(false)
const loginLogHeaders = [
    { title: '員工編號', key: 'employee_id', sortable: true },
    { title: '姓名', key: 'employee.name', sortable: false },
    { title: '登入時間', key: 'created_at', sortable: true }
]

// VC 發行記錄
const vcLogs = ref([])
const vcLogsLoading = ref(false)
const vcLogHeaders = [
    { title: '員工編號', key: 'employee_id', sortable: true },
    { title: 'VC UID', key: 'vc_uid', sortable: true },
    { title: 'VC CID', key: 'vc_cid', sortable: false },
    { title: '發行時間', key: 'created_at', sortable: true }
]

// VP 驗證記錄
const vpLogs = ref([])
const vpLogsLoading = ref(false)
const vpLogHeaders = [
    { title: '交易 ID', key: 'transaction_id', sortable: false },
    { title: '驗證結果', key: 'verify_result', sortable: true },
    { title: '驗證時間', key: 'created_at', sortable: true }
]

// VC 狀態變更記錄
const vcStatusLogs = ref([])
const vcStatusLogsLoading = ref(false)
const vcStatusLogHeaders = [
    { title: '員工編號', key: 'employee_id', sortable: true },
    { title: '姓名', key: 'employee.name', sortable: false },
    { title: '操作', key: 'action', sortable: true },
    { title: '原因', key: 'reason', sortable: false },
    { title: '操作時間', key: 'created_at', sortable: true }
]

// 病假申請記錄
const medicalLeaves = ref([])
const medicalLeavesLoading = ref(false)
const medicalLeaveHeaders = [
    { title: '員工編號', key: 'employee_id', sortable: true },
    { title: '姓名', key: 'employee.name', sortable: false },
    { title: '請假起始日', key: 'leave_start_date', sortable: true },
    { title: '請假結束日', key: 'leave_end_date', sortable: true },
    { title: '請假天數', key: 'leave_days', sortable: true },
    { title: '醫療院所', key: 'hospital_name', sortable: false },
    { title: '診斷日期', key: 'diagnosis_date', sortable: true },
    { title: '申請時間', key: 'created_at', sortable: true }
]

// 病假 VP 驗證記錄
const medicalLeaveVPLogs = ref([])
const medicalLeaveVPLogsLoading = ref(false)
const medicalLeaveVPLogHeaders = [
    { title: '員工編號', key: 'employee_id', sortable: true },
    { title: '姓名', key: 'employee.name', sortable: false },
    { title: '交易 ID', key: 'transaction_id', sortable: false },
    { title: '驗證結果', key: 'verify_result', sortable: true },
    { title: '拒絕原因', key: 'rejection_reason', sortable: false },
    { title: '驗證時間', key: 'verified_at', sortable: true }
]

// 活動日誌
const activityLogs = ref([])
const activityLogsLoading = ref(false)
const activityStats = ref(null)
const activityLogFilters = ref({
    action: null,
    status: null,
    employee_id: null,
})
const activityLogHeaders = [
    { title: '員工編號', key: 'employee_id', sortable: true },
    { title: '操作者', key: 'actor_id', sortable: true },
    { title: '操作者類型', key: 'actor_type', sortable: true },
    { title: '行為', key: 'action_display', sortable: false },
    { title: '描述', key: 'description', sortable: false },
    { title: '狀態', key: 'status', sortable: true },
    { title: '時間', key: 'created_at', sortable: true }
]
const actionTypes = [
    { title: '發行憑證', value: 'issue_vc' },
    { title: '驗證 VP', value: 'verify_vp' },
    { title: '撤銷憑證', value: 'revoke_vc' },
    { title: '應徵申請', value: 'apply_job' },
    { title: '申請病假', value: 'apply_leave' },
]
const statusTypes = [
    { title: '成功', value: 'success' },
    { title: '失敗', value: 'failed' },
]

// 撤銷憑證
const showRevokeDialog = ref(false)
const selectedEmployee = ref(null)
const revokeReason = ref('')
const revokeLoading = ref(false)

// 發行/換發憑證
const showReissueDialog = ref(false)
const reissueStep = ref(1)
const reissueLoading = ref(false)
const reissueQRData = ref(null)
const reissueScanner = ref(null)

// 載入資料
const loadEmployees = async () => {
    employeesLoading.value = true
    try {
        const response = await fetch(`/api/admin/employees?search=${employeeSearch.value}`)
        const data = await response.json()
        employees.value = data.data
        stats.value.totalEmployees = data.total
        stats.value.totalVCIssued = data.data.filter(e => e.employee_vc_cid).length
    } catch (error) {
        console.error('載入員工資料失敗:', error)
    } finally {
        employeesLoading.value = false
    }
}

const loadLoginLogs = async () => {
    loginLogsLoading.value = true
    try {
        const response = await fetch('/api/admin/login-logs')
        const data = await response.json()
        loginLogs.value = data.data
        stats.value.totalLogins = data.total
    } catch (error) {
        console.error('載入登入記錄失敗:', error)
    } finally {
        loginLogsLoading.value = false
    }
}

const loadVCLogs = async () => {
    vcLogsLoading.value = true
    try {
        const response = await fetch('/api/admin/vc-issued-logs')
        const data = await response.json()
        vcLogs.value = data.data
    } catch (error) {
        console.error('載入 VC 發行記錄失敗:', error)
    } finally {
        vcLogsLoading.value = false
    }
}

const loadVPLogs = async () => {
    vpLogsLoading.value = true
    try {
        const response = await fetch('/api/admin/vp-verification-logs')
        const data = await response.json()
        vpLogs.value = data.data
        stats.value.totalVPVerifications = data.total
    } catch (error) {
        console.error('載入 VP 驗證記錄失敗:', error)
    } finally {
        vpLogsLoading.value = false
    }
}

const loadVCStatusLogs = async () => {
    vcStatusLogsLoading.value = true
    try {
        const response = await fetch('/api/admin/vc-status-change-logs')
        const data = await response.json()
        vcStatusLogs.value = data.data
    } catch (error) {
        console.error('載入 VC 狀態變更記錄失敗:', error)
    } finally {
        vcStatusLogsLoading.value = false
    }
}

const loadMedicalLeaves = async () => {
    medicalLeavesLoading.value = true
    try {
        const response = await fetch('/api/admin/medical-leaves')
        const data = await response.json()
        if (data.success) {
            medicalLeaves.value = data.data
            stats.value.totalMedicalLeaves = data.meta.total
        }
    } catch (error) {
        console.error('載入病假申請記錄失敗:', error)
    } finally {
        medicalLeavesLoading.value = false
    }
}

const loadMedicalLeaveVPLogs = async () => {
    medicalLeaveVPLogsLoading.value = true
    try {
        const response = await fetch('/api/admin/medical-leave-vp-logs')
        const data = await response.json()
        if (data.success) {
            medicalLeaveVPLogs.value = data.data
        }
    } catch (error) {
        console.error('載入病假 VP 驗證記錄失敗:', error)
    } finally {
        medicalLeaveVPLogsLoading.value = false
    }
}

const loadActivityLogs = async () => {
    activityLogsLoading.value = true
    try {
        const params = new URLSearchParams()
        if (activityLogFilters.value.action) {
            params.append('action', activityLogFilters.value.action)
        }
        if (activityLogFilters.value.status) {
            params.append('status', activityLogFilters.value.status)
        }
        if (activityLogFilters.value.employee_id) {
            params.append('employee_id', activityLogFilters.value.employee_id)
        }

        const response = await fetch(`/api/admin/activity-logs?${params}`)
        const data = await response.json()
        if (data.success) {
            activityLogs.value = data.data
        }
    } catch (error) {
        console.error('載入活動日誌失敗:', error)
    } finally {
        activityLogsLoading.value = false
    }
}

const loadActivityStats = async () => {
    try {
        const response = await fetch('/api/admin/activity-stats')
        const data = await response.json()
        if (data.success) {
            activityStats.value = data.data
        }
    } catch (error) {
        console.error('載入活動統計失敗:', error)
    }
}

const searchEmployees = () => {
    loadEmployees()
}

// 撤銷憑證
const openRevokeDialog = (employee) => {
    selectedEmployee.value = employee
    revokeReason.value = ''
    showRevokeDialog.value = true
}

const confirmRevoke = async () => {
    if (!revokeReason.value.trim()) {
        alert('請輸入撤銷原因')
        return
    }

    revokeLoading.value = true
    try {
        const response = await fetch(`/api/admin/employees/${selectedEmployee.value.employee_id}/revoke`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                employee_id: selectedEmployee.value.employee_id,
                reason: revokeReason.value
            })
        })

        const data = await response.json()

        if (!response.ok) {
            throw new Error(data.message || '撤銷失敗')
        }

        alert('憑證已成功撤銷')
        showRevokeDialog.value = false
        loadEmployees()
        loadVCStatusLogs()
    } catch (error) {
        alert('撤銷失敗：' + error.message)
    } finally {
        revokeLoading.value = false
    }
}

// 發行/換發憑證
const openReissueDialog = (employee) => {
    selectedEmployee.value = employee
    reissueStep.value = 1
    reissueQRData.value = null
    showReissueDialog.value = true
}

const startReissue = async () => {
    reissueLoading.value = true
    try {
        const response = await fetch(`/api/admin/employees/${selectedEmployee.value.employee_id}/reissue`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                employee_id: selectedEmployee.value.employee_id
            })
        })

        const data = await response.json()

        if (!response.ok) {
            throw new Error(data.message || '發行失敗')
        }

        reissueQRData.value = {
            qrCode: data.qrCode,
            deepLink: data.deepLink,
            transactionId: data.transactionId
        }

        reissueStep.value = 2
    } catch (error) {
        alert('發行失敗：' + error.message)
    } finally {
        reissueLoading.value = false
    }
}

const handleReissueSuccess = async ({ cid, transactionId }) => {
    reissueStep.value = 3

    // 重新載入資料
    await loadEmployees()
    await loadVCLogs()

    if (selectedEmployee.value.employee_vc_cid) {
        await loadVCStatusLogs()
    }

    setTimeout(() => {
        closeReissueDialog()
    }, 2000)
}

const closeReissueDialog = () => {
    showReissueDialog.value = false
    reissueScanner.value?.reset()
}

// 工具函數
const formatDateTime = (datetime) => {
    if (!datetime) return '-'
    return new Date(datetime).toLocaleString('zh-TW')
}

const getActionColor = (action) => {
    switch (action) {
        case 'revocation': return 'error'
        case 'suspension': return 'warning'
        case 'recovery': return 'success'
        default: return 'grey'
    }
}

const getActorTypeColor = (actorType) => {
    switch (actorType) {
        case 'admin': return 'error'
        case 'employee': return 'success'
        case 'system': return 'info'
        default: return 'grey'
    }
}

onMounted(() => {
    loadEmployees()
    loadLoginLogs()
    loadVCLogs()
    loadVPLogs()
    loadVCStatusLogs()
    loadMedicalLeaves()
    loadMedicalLeaveVPLogs()
    loadActivityLogs()
    loadActivityStats()
})
</script>

<style scoped>
.bg-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}
</style>
