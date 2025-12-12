<template>
    <v-app>
        <v-app-bar color="primary" elevation="2">
            <v-btn icon @click="$router.push({ name: 'AdminDashboard' })">
                <v-icon>mdi-arrow-left</v-icon>
            </v-btn>
            <v-app-bar-title class="text-h5 font-weight-bold">
                <v-icon class="mr-2">mdi-medical-bag</v-icon>
                病假審核
            </v-app-bar-title>
            <v-spacer />
            <v-btn icon @click="$router.push({ name: 'Home' })">
                <v-icon>mdi-home</v-icon>
            </v-btn>
        </v-app-bar>

        <v-main class="bg-grey-lighten-4">
            <v-container fluid class="pa-6">
                <!-- 統計卡片 -->
                <v-row class="mb-4">
                    <v-col cols="12" md="3">
                        <v-card elevation="2">
                            <v-card-text class="text-center">
                                <v-icon size="40" color="info">mdi-clock-outline</v-icon>
                                <div class="text-h5 mt-2">{{ statistics.pending }}</div>
                                <div class="text-caption">待審核</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-card elevation="2">
                            <v-card-text class="text-center">
                                <v-icon size="40" color="success">mdi-check-circle</v-icon>
                                <div class="text-h5 mt-2">{{ statistics.approved }}</div>
                                <div class="text-caption">已核准</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-card elevation="2">
                            <v-card-text class="text-center">
                                <v-icon size="40" color="error">mdi-close-circle</v-icon>
                                <div class="text-h5 mt-2">{{ statistics.rejected }}</div>
                                <div class="text-caption">已駁回</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="3">
                        <v-card elevation="2">
                            <v-card-text class="text-center">
                                <v-icon size="40" color="primary">mdi-calendar</v-icon>
                                <div class="text-h5 mt-2">{{ statistics.total_leave_days }}</div>
                                <div class="text-caption">總病假天數</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>

                <!-- 篩選 -->
                <v-card class="mb-4" elevation="2">
                    <v-card-text>
                        <v-row>
                            <v-col cols="12" md="3">
                                <v-text-field
                                    v-model="filters.search"
                                    label="搜尋員工"
                                    prepend-inner-icon="mdi-magnify"
                                    placeholder="員工編號或姓名"
                                    clearable
                                    @update:model-value="loadMedicalLeaves"
                                />
                            </v-col>
                            <v-col cols="12" md="3">
                                <v-select
                                    v-model="filters.status"
                                    label="審核狀態"
                                    :items="statusOptions"
                                    @update:model-value="loadMedicalLeaves"
                                />
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>

                <!-- 病假申請列表 -->
                <v-card elevation="2">
                    <v-card-title>
                        病假申請列表
                        <v-spacer />
                        <v-chip color="primary">
                            總計：{{ medicalLeaves.length }} 筆
                        </v-chip>
                    </v-card-title>

                    <v-data-table
                        :headers="headers"
                        :items="medicalLeaves"
                        :loading="loading"
                        class="elevation-1"
                    >
                        <template #item.status="{ item }">
                            <v-chip
                                :color="getStatusColor(item.status)"
                                size="small"
                            >
                                {{ getStatusText(item.status) }}
                            </v-chip>
                        </template>

                        <template #item.leave_days="{ item }">
                            {{ item.leave_days }} 天
                        </template>

                        <template #item.actions="{ item }">
                            <v-btn
                                size="small"
                                color="primary"
                                variant="text"
                                @click="viewDetails(item)"
                            >
                                詳情
                            </v-btn>
                            <v-btn
                                v-if="item.status === 'pending'"
                                size="small"
                                color="success"
                                variant="text"
                                @click="openApproveDialog(item)"
                            >
                                通過
                            </v-btn>
                            <v-btn
                                v-if="item.status === 'pending'"
                                size="small"
                                color="error"
                                variant="text"
                                @click="openRejectDialog(item)"
                            >
                                駁回
                            </v-btn>
                        </template>
                    </v-data-table>
                </v-card>

                <!-- 詳情對話框 -->
                <v-dialog v-model="detailsDialog" max-width="700">
                    <v-card v-if="selectedLeave">
                        <v-card-title class="text-h5 bg-primary">
                            <v-icon class="mr-2">mdi-file-document</v-icon>
                            病假申請詳情
                        </v-card-title>

                        <v-divider />

                        <v-card-text class="pa-6">
                            <h3 class="text-h6 mb-3">員工資訊</h3>
                            <v-row>
                                <v-col cols="6">
                                    <div><strong>員工編號：</strong>{{ selectedLeave.employee?.employee_id }}</div>
                                    <div><strong>姓名：</strong>{{ selectedLeave.employee?.name }}</div>
                                </v-col>
                                <v-col cols="6">
                                    <div><strong>部門：</strong>{{ selectedLeave.employee?.department }}</div>
                                    <div><strong>職位：</strong>{{ selectedLeave.employee?.position }}</div>
                                </v-col>
                            </v-row>

                            <v-divider class="my-4" />

                            <h3 class="text-h6 mb-3">診斷證明資訊（來自 VP）</h3>
                            <v-row>
                                <v-col cols="6">
                                    <div><strong>醫療院所：</strong>{{ selectedLeave.hospital_name }}</div>
                                    <div><strong>醫師姓名：</strong>{{ selectedLeave.doctor_name }}</div>
                                </v-col>
                                <v-col cols="6">
                                    <div><strong>建議休養期間：</strong></div>
                                    <div>{{ selectedLeave.rest_start_date }} ~ {{ selectedLeave.rest_end_date }}</div>
                                </v-col>
                            </v-row>
                            <div class="mt-2">
                                <strong>醫師建議：</strong>
                                <p>{{ selectedLeave.doctor_recommendation }}</p>
                            </div>

                            <v-divider class="my-4" />

                            <h3 class="text-h6 mb-3">請假資訊</h3>
                            <v-row>
                                <v-col cols="6">
                                    <div><strong>請假起訖：</strong></div>
                                    <div>{{ selectedLeave.leave_start_date }} ~ {{ selectedLeave.leave_end_date }}</div>
                                </v-col>
                                <v-col cols="6">
                                    <div><strong>請假天數：</strong>{{ selectedLeave.leave_days }} 天</div>
                                    <div><strong>申請時間：</strong>{{ formatDate(selectedLeave.created_at) }}</div>
                                </v-col>
                            </v-row>

                            <v-divider class="my-4" />

                            <h3 class="text-h6 mb-3">審核狀態</h3>
                            <div>
                                <v-chip :color="getStatusColor(selectedLeave.status)" class="mb-2">
                                    {{ getStatusText(selectedLeave.status) }}
                                </v-chip>
                            </div>
                            <div v-if="selectedLeave.status !== 'pending'">
                                <div><strong>審核者：</strong>{{ selectedLeave.reviewed_by }}</div>
                                <div><strong>審核時間：</strong>{{ formatDate(selectedLeave.reviewed_at) }}</div>
                                <div v-if="selectedLeave.review_note">
                                    <strong>審核備註：</strong>
                                    <p>{{ selectedLeave.review_note }}</p>
                                </div>
                            </div>
                        </v-card-text>

                        <v-divider />

                        <v-card-actions>
                            <v-spacer />
                            <v-btn
                                v-if="selectedLeave.status === 'pending'"
                                color="success"
                                @click="openApproveDialog(selectedLeave)"
                            >
                                核准
                            </v-btn>
                            <v-btn
                                v-if="selectedLeave.status === 'pending'"
                                color="error"
                                @click="openRejectDialog(selectedLeave)"
                            >
                                駁回
                            </v-btn>
                            <v-btn color="grey" variant="text" @click="detailsDialog = false">
                                關閉
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>

                <!-- 核准對話框 -->
                <v-dialog v-model="approveDialog" max-width="500">
                    <v-card>
                        <v-card-title>核准病假申請</v-card-title>
                        <v-card-text>
                            <p class="mb-4">
                                確定要核准 <strong>{{ approveTarget?.employee?.name }}</strong> 的病假申請嗎？
                            </p>
                            <v-text-field
                                v-model="reviewedBy"
                                label="審核者"
                                required
                            />
                            <v-textarea
                                v-model="reviewNote"
                                label="審核備註（選填）"
                                rows="3"
                            />
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer />
                            <v-btn color="grey" variant="text" @click="approveDialog = false">取消</v-btn>
                            <v-btn color="success" @click="confirmApprove">確定核准</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>

                <!-- 駁回對話框 -->
                <v-dialog v-model="rejectDialog" max-width="500">
                    <v-card>
                        <v-card-title>駁回病假申請</v-card-title>
                        <v-card-text>
                            <p class="mb-4">
                                確定要駁回 <strong>{{ rejectTarget?.employee?.name }}</strong> 的病假申請嗎？
                            </p>
                            <v-text-field
                                v-model="reviewedBy"
                                label="審核者"
                                required
                            />
                            <v-textarea
                                v-model="reviewNote"
                                label="駁回原因（必填）"
                                rows="3"
                                required
                            />
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer />
                            <v-btn color="grey" variant="text" @click="rejectDialog = false">取消</v-btn>
                            <v-btn color="error" @click="confirmReject">確定駁回</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>

                <!-- Snackbar -->
                <v-snackbar v-model="snackbar" :color="snackbarColor" :timeout="3000">
                    {{ snackbarText }}
                </v-snackbar>
            </v-container>
        </v-main>
    </v-app>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const loading = ref(false)
const medicalLeaves = ref([])
const statistics = ref({
    total: 0,
    pending: 0,
    approved: 0,
    rejected: 0,
    total_leave_days: 0
})

const filters = ref({
    search: '',
    status: ''
})

const statusOptions = [
    { title: '全部', value: '' },
    { title: '待審核', value: 'pending' },
    { title: '已核准', value: 'approved' },
    { title: '已駁回', value: 'rejected' }
]

const headers = [
    { title: '員工編號', key: 'employee.employee_id' },
    { title: '員工姓名', key: 'employee.name' },
    { title: '請假起訖', key: 'leave_start_date' },
    { title: '天數', key: 'leave_days' },
    { title: '申請時間', key: 'created_at' },
    { title: '狀態', key: 'status' },
    { title: '操作', key: 'actions', sortable: false }
]

const detailsDialog = ref(false)
const selectedLeave = ref(null)

const approveDialog = ref(false)
const approveTarget = ref(null)

const rejectDialog = ref(false)
const rejectTarget = ref(null)

const reviewedBy = ref('管理員')
const reviewNote = ref('')

const snackbar = ref(false)
const snackbarText = ref('')
const snackbarColor = ref('success')

const loadStatistics = async () => {
    try {
        const response = await axios.get('/api/admin/medical-leaves/statistics')
        statistics.value = response.data.statistics
    } catch (error) {
        console.error(error)
    }
}

const loadMedicalLeaves = async () => {
    loading.value = true
    try {
        const params = {}
        if (filters.value.search) params.search = filters.value.search
        if (filters.value.status) params.status = filters.value.status

        const response = await axios.get('/api/admin/medical-leaves', { params })
        medicalLeaves.value = response.data.medical_leaves.data || response.data.medical_leaves
    } catch (error) {
        showSnackbar('載入病假資料失敗', 'error')
        console.error(error)
    } finally {
        loading.value = false
    }
}

const viewDetails = async (leave) => {
    try {
        const response = await axios.get(`/api/admin/medical-leaves/${leave.id}`)
        selectedLeave.value = response.data.medical_leave
        detailsDialog.value = true
    } catch (error) {
        showSnackbar('載入詳情失敗', 'error')
        console.error(error)
    }
}

const openApproveDialog = (leave) => {
    approveTarget.value = leave
    reviewedBy.value = '管理員'
    reviewNote.value = ''
    approveDialog.value = true
    detailsDialog.value = false
}

const confirmApprove = async () => {
    if (!reviewedBy.value) {
        showSnackbar('請輸入審核者', 'warning')
        return
    }

    try {
        await axios.post(`/api/admin/medical-leaves/${approveTarget.value.id}/approve`, {
            reviewed_by: reviewedBy.value,
            review_note: reviewNote.value
        })

        showSnackbar('病假申請已核准', 'success')
        approveDialog.value = false
        await loadMedicalLeaves()
        await loadStatistics()
    } catch (error) {
        showSnackbar('核准失敗', 'error')
        console.error(error)
    }
}

const openRejectDialog = (leave) => {
    rejectTarget.value = leave
    reviewedBy.value = '管理員'
    reviewNote.value = ''
    rejectDialog.value = true
    detailsDialog.value = false
}

const confirmReject = async () => {
    if (!reviewedBy.value || !reviewNote.value) {
        showSnackbar('請輸入審核者和駁回原因', 'warning')
        return
    }

    try {
        await axios.post(`/api/admin/medical-leaves/${rejectTarget.value.id}/reject`, {
            reviewed_by: reviewedBy.value,
            review_note: reviewNote.value
        })

        showSnackbar('病假申請已駁回', 'success')
        rejectDialog.value = false
        await loadMedicalLeaves()
        await loadStatistics()
    } catch (error) {
        showSnackbar('駁回失敗', 'error')
        console.error(error)
    }
}

const getStatusColor = (status) => {
    const colors = {
        pending: 'info',
        approved: 'success',
        rejected: 'error'
    }
    return colors[status] || 'grey'
}

const getStatusText = (status) => {
    const texts = {
        pending: '待審核',
        approved: '已核准',
        rejected: '已駁回'
    }
    return texts[status] || status
}

const showSnackbar = (text, color = 'success') => {
    snackbarText.value = text
    snackbarColor.value = color
    snackbar.value = true
}

const formatDate = (dateString) => {
    if (!dateString) return ''
    return new Date(dateString).toLocaleString('zh-TW')
}

onMounted(() => {
    loadStatistics()
    loadMedicalLeaves()
})
</script>

<style scoped>
.bg-grey-lighten-4 {
    background-color: #f5f5f5;
}
</style>
