<template>
    <v-container fluid class="admin-visitor-parking-page">
        <v-row>
            <v-col cols="12">
                <!-- 頁面標題 -->
                <v-card class="mb-6" elevation="2">
                    <v-card-title class="text-h4 bg-teal pa-6">
                        <v-icon size="large" class="mr-3">mdi-car-parking-lights</v-icon>
                        訪客停車證審核管理
                    </v-card-title>
                </v-card>

                <!-- 統計資訊 -->
                <v-row class="mb-6">
                    <v-col cols="12" sm="6" md="3">
                        <v-card elevation="2" color="blue-lighten-5">
                            <v-card-text>
                                <div class="text-overline">總申請數</div>
                                <div class="text-h4">{{ statistics.total }}</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" sm="6" md="3">
                        <v-card elevation="2" color="orange-lighten-5">
                            <v-card-text>
                                <div class="text-overline">待審核</div>
                                <div class="text-h4">{{ statistics.pending }}</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" sm="6" md="3">
                        <v-card elevation="2" color="green-lighten-5">
                            <v-card-text>
                                <div class="text-overline">已核准</div>
                                <div class="text-h4">{{ statistics.approved }}</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" sm="6" md="3">
                        <v-card elevation="2" color="teal-lighten-5">
                            <v-card-text>
                                <div class="text-overline">已領取</div>
                                <div class="text-h4">{{ statistics.issued }}</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>

                <!-- 篩選與搜尋 -->
                <v-card class="mb-6" elevation="2">
                    <v-card-text>
                        <v-row>
                            <v-col cols="12" md="4">
                                <v-select
                                    v-model="filters.status"
                                    label="狀態篩選"
                                    :items="statusOptions"
                                    clearable
                                    variant="outlined"
                                    density="comfortable"
                                    @update:model-value="loadApplications"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    v-model="filters.email"
                                    label="電子郵件搜尋"
                                    prepend-inner-icon="mdi-magnify"
                                    clearable
                                    variant="outlined"
                                    density="comfortable"
                                    @update:model-value="debouncedSearch"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="4">
                                <v-select
                                    v-model="filters.sort_by"
                                    label="排序方式"
                                    :items="sortOptions"
                                    variant="outlined"
                                    density="comfortable"
                                    @update:model-value="loadApplications"
                                ></v-select>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>

                <!-- 申請列表 -->
                <v-card elevation="2">
                    <v-card-title class="bg-grey-lighten-4">
                        <v-icon class="mr-2">mdi-format-list-bulleted</v-icon>
                        申請列表
                    </v-card-title>

                    <v-card-text v-if="loading" class="text-center pa-10">
                        <v-progress-circular
                            indeterminate
                            color="teal"
                            size="64"
                        ></v-progress-circular>
                        <p class="mt-4">載入中...</p>
                    </v-card-text>

                    <v-card-text v-else-if="applications.length === 0" class="text-center pa-10">
                        <v-icon size="80" color="grey">mdi-inbox</v-icon>
                        <p class="mt-4 text-h6 text-grey">目前沒有申請記錄</p>
                    </v-card-text>

                    <v-data-table
                        v-else
                        :headers="headers"
                        :items="applications"
                        :items-per-page="pagination.per_page"
                        hide-default-footer
                        class="elevation-0"
                    >
                        <!-- 狀態欄 -->
                        <template v-slot:item.status="{ item }">
                            <v-chip
                                :color="getStatusColor(item.status)"
                                size="small"
                                variant="flat"
                            >
                                {{ item.status_text }}
                            </v-chip>
                        </template>

                        <!-- 領取狀態欄 -->
                        <template v-slot:item.is_issued="{ item }">
                            <v-chip
                                :color="item.is_issued ? 'success' : 'grey'"
                                size="small"
                                variant="flat"
                            >
                                {{ item.is_issued ? '已領取' : '未領取' }}
                            </v-chip>
                        </template>

                        <!-- 停車期間欄 -->
                        <template v-slot:item.parking_period="{ item }">
                            <div class="text-caption">
                                {{ item.parking_start_date }}<br>~<br>{{ item.parking_end_date }}
                            </div>
                        </template>

                        <!-- 操作欄 -->
                        <template v-slot:item.actions="{ item }">
                            <v-btn
                                size="small"
                                color="primary"
                                variant="text"
                                @click="viewApplication(item)"
                            >
                                查看
                            </v-btn>
                        </template>
                    </v-data-table>

                    <!-- 分頁 -->
                    <v-divider></v-divider>
                    <div class="d-flex justify-center pa-4">
                        <v-pagination
                            v-model="pagination.current_page"
                            :length="pagination.last_page"
                            :total-visible="7"
                            @update:model-value="loadApplications"
                        ></v-pagination>
                    </div>
                </v-card>
            </v-col>
        </v-row>

        <!-- 申請詳情對話框 -->
        <v-dialog v-model="showDetailDialog" max-width="800" persistent>
            <v-card v-if="selectedApplication">
                <v-card-title class="bg-teal">
                    <v-icon class="mr-2">mdi-file-document</v-icon>
                    申請詳情
                </v-card-title>

                <v-card-text class="pt-6">
                    <!-- 狀態顯示 -->
                    <v-alert
                        :type="getStatusColor(selectedApplication.status)"
                        variant="tonal"
                        class="mb-6"
                    >
                        <v-alert-title>
                            {{ selectedApplication.status_text }}
                        </v-alert-title>
                    </v-alert>

                    <!-- 訪客資訊 -->
                    <v-card variant="outlined" class="mb-4">
                        <v-card-title class="bg-grey-lighten-4">訪客資訊</v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-2 text-grey">姓名</div>
                                    <div class="text-body-1">{{ selectedApplication.name || '-' }}</div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-2 text-grey">電子郵件</div>
                                    <div class="text-body-1">{{ selectedApplication.email }}</div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-2 text-grey">申請時間</div>
                                    <div class="text-body-1">{{ selectedApplication.created_at }}</div>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-2 text-grey">申請原因</div>
                                    <div class="text-body-1">{{ selectedApplication.application_reason }}</div>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>

                    <!-- 車輛資訊 -->
                    <v-card variant="outlined" class="mb-4">
                        <v-card-title class="bg-grey-lighten-4">車輛資訊</v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-2 text-grey">車牌號碼</div>
                                    <div class="text-body-1 font-weight-bold">{{ selectedApplication.vehicle_plate_number }}</div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-2 text-grey">車種</div>
                                    <div class="text-body-1">{{ selectedApplication.vehicle_type }}</div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-2 text-grey">廠牌與車型</div>
                                    <div class="text-body-1">{{ selectedApplication.brand_model }}</div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-2 text-grey">車色</div>
                                    <div class="text-body-1">{{ selectedApplication.color }}</div>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>

                    <!-- 停車期間 -->
                    <v-card variant="outlined" class="mb-4">
                        <v-card-title class="bg-grey-lighten-4">停車期間</v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-2 text-grey">停車起始日</div>
                                    <div class="text-body-1">{{ selectedApplication.parking_start_date }}</div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-2 text-grey">停車結束日</div>
                                    <div class="text-body-1">{{ selectedApplication.parking_end_date }}</div>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>

                    <!-- 停車證資訊（如果已核准） -->
                    <v-card v-if="selectedApplication.status === 'approved'" variant="outlined" class="mb-4">
                        <v-card-title class="bg-grey-lighten-4">停車證資訊</v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-2 text-grey">停車證編號</div>
                                    <div class="text-body-1 font-weight-bold text-teal">
                                        {{ selectedApplication.permit_id }}
                                    </div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-2 text-grey">領取狀態</div>
                                    <v-chip
                                        :color="selectedApplication.is_issued ? 'success' : 'grey'"
                                        size="small"
                                        variant="flat"
                                    >
                                        {{ selectedApplication.is_issued ? '已領取' : '未領取' }}
                                    </v-chip>
                                </v-col>
                                <v-col cols="12">
                                    <div class="text-subtitle-2 text-grey">領取連結</div>
                                    <div class="text-body-2">
                                        <a :href="selectedApplication.claim_url" target="_blank">
                                            {{ selectedApplication.claim_url }}
                                        </a>
                                        <v-btn
                                            size="x-small"
                                            variant="text"
                                            color="primary"
                                            @click="copyClaimUrl"
                                            class="ml-2"
                                        >
                                            <v-icon>mdi-content-copy</v-icon>
                                        </v-btn>
                                    </div>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>

                    <!-- 審核資訊（如果已審核） -->
                    <v-card v-if="selectedApplication.reviewed_at" variant="outlined" class="mb-4">
                        <v-card-title class="bg-grey-lighten-4">審核資訊</v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-2 text-grey">審核者</div>
                                    <div class="text-body-1">{{ selectedApplication.reviewer_name || '系統' }}</div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="text-subtitle-2 text-grey">審核時間</div>
                                    <div class="text-body-1">{{ selectedApplication.reviewed_at }}</div>
                                </v-col>
                                <v-col v-if="selectedApplication.review_note" cols="12">
                                    <div class="text-subtitle-2 text-grey">審核備註</div>
                                    <div class="text-body-1">{{ selectedApplication.review_note }}</div>
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>

                    <!-- 審核操作（如果狀態為 pending） -->
                    <v-card v-if="selectedApplication.status === 'pending'" variant="outlined" color="warning">
                        <v-card-title class="bg-warning-lighten-4">審核操作</v-card-title>
                        <v-card-text>
                            <v-textarea
                                v-model="reviewNote"
                                label="審核備註"
                                rows="3"
                                variant="outlined"
                                :placeholder="reviewAction === 'reject' ? '請填寫拒絕原因（必填）' : '選填'"
                            ></v-textarea>
                        </v-card-text>
                    </v-card>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        variant="text"
                        @click="closeDetailDialog"
                        :disabled="processing"
                    >
                        關閉
                    </v-btn>
                    <v-btn
                        v-if="selectedApplication.status === 'pending'"
                        color="error"
                        variant="elevated"
                        @click="handleReject"
                        :loading="processing && reviewAction === 'reject'"
                        :disabled="processing"
                    >
                        拒絕
                    </v-btn>
                    <v-btn
                        v-if="selectedApplication.status === 'pending'"
                        color="success"
                        variant="elevated"
                        @click="handleApprove"
                        :loading="processing && reviewAction === 'approve'"
                        :disabled="processing"
                    >
                        核准
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const loading = ref(false)
const applications = ref([])
const statistics = ref({
    total: 0,
    pending: 0,
    approved: 0,
    rejected: 0,
    issued: 0,
})

const filters = ref({
    status: '',
    email: '',
    sort_by: 'created_at',
})

const pagination = ref({
    current_page: 1,
    last_page: 1,
    per_page: 20,
    total: 0,
})

const statusOptions = [
    { title: '全部', value: '' },
    { title: '待審核', value: 'pending' },
    { title: '已核准', value: 'approved' },
    { title: '已拒絕', value: 'rejected' },
]

const sortOptions = [
    { title: '申請時間（新到舊）', value: 'created_at' },
    { title: '申請時間（舊到新）', value: 'created_at_asc' },
    { title: '審核時間', value: 'reviewed_at' },
]

const headers = [
    { title: 'ID', value: 'id', sortable: false },
    { title: '電子郵件', value: 'email', sortable: false },
    { title: '車牌號碼', value: 'vehicle_plate_number', sortable: false },
    { title: '停車期間', value: 'parking_period', sortable: false },
    { title: '狀態', value: 'status', sortable: false },
    { title: '領取狀態', value: 'is_issued', sortable: false },
    { title: '申請時間', value: 'created_at', sortable: false },
    { title: '操作', value: 'actions', sortable: false, align: 'center' },
]

const showDetailDialog = ref(false)
const selectedApplication = ref(null)
const reviewNote = ref('')
const reviewAction = ref('')
const processing = ref(false)

// Debounce timer
let searchTimeout = null

// 載入申請列表
const loadApplications = async () => {
    loading.value = true

    try {
        const params = {
            page: pagination.value.current_page,
            per_page: pagination.value.per_page,
            status: filters.value.status,
            email: filters.value.email,
            sort_by: filters.value.sort_by.replace('_asc', ''),
            sort_order: filters.value.sort_by.includes('_asc') ? 'asc' : 'desc',
        }

        const response = await axios.get('/api/admin/visitor-parking/applications', { params })

        if (response.data.success) {
            applications.value = response.data.data
            pagination.value = {
                current_page: response.data.meta.current_page,
                last_page: response.data.meta.last_page,
                per_page: response.data.meta.per_page,
                total: response.data.meta.total,
            }
        }
    } catch (error) {
        console.error('載入申請列表失敗:', error)
        alert('載入申請列表失敗')
    } finally {
        loading.value = false
    }
}

// 載入統計資訊
const loadStatistics = async () => {
    try {
        const response = await axios.get('/api/admin/visitor-parking/applications/statistics')

        if (response.data.success) {
            statistics.value = response.data.data
        }
    } catch (error) {
        console.error('載入統計資訊失敗:', error)
    }
}

// Debounced search
const debouncedSearch = () => {
    clearTimeout(searchTimeout)
    searchTimeout = setTimeout(() => {
        loadApplications()
    }, 500)
}

// 查看申請詳情
const viewApplication = async (application) => {
    try {
        const response = await axios.get(`/api/admin/visitor-parking/applications/${application.id}`)

        if (response.data.success) {
            selectedApplication.value = response.data.data
            showDetailDialog.value = true
            reviewNote.value = ''
            reviewAction.value = ''
        }
    } catch (error) {
        console.error('載入申請詳情失敗:', error)
        alert('載入申請詳情失敗')
    }
}

// 核准申請
const handleApprove = async () => {
    if (!confirm('確定要核准此申請嗎？核准後將自動發行停車證。')) {
        return
    }

    reviewAction.value = 'approve'
    processing.value = true

    try {
        const response = await axios.post(
            `/api/admin/visitor-parking/applications/${selectedApplication.value.id}/approve`,
            { review_note: reviewNote.value }
        )

        if (response.data.success) {
            alert('申請已核准，停車證已發行')
            closeDetailDialog()
            await loadApplications()
            await loadStatistics()
        }
    } catch (error) {
        console.error('核准申請失敗:', error)
        alert(error.response?.data?.message || '核准申請失敗')
    } finally {
        processing.value = false
        reviewAction.value = ''
    }
}

// 拒絕申請
const handleReject = async () => {
    if (!reviewNote.value) {
        alert('請填寫拒絕原因')
        return
    }

    if (!confirm('確定要拒絕此申請嗎？')) {
        return
    }

    reviewAction.value = 'reject'
    processing.value = true

    try {
        const response = await axios.post(
            `/api/admin/visitor-parking/applications/${selectedApplication.value.id}/reject`,
            { review_note: reviewNote.value }
        )

        if (response.data.success) {
            alert('申請已拒絕')
            closeDetailDialog()
            await loadApplications()
            await loadStatistics()
        }
    } catch (error) {
        console.error('拒絕申請失敗:', error)
        alert(error.response?.data?.message || '拒絕申請失敗')
    } finally {
        processing.value = false
        reviewAction.value = ''
    }
}

// 關閉詳情對話框
const closeDetailDialog = () => {
    showDetailDialog.value = false
    selectedApplication.value = null
    reviewNote.value = ''
    reviewAction.value = ''
}

// 複製領取連結
const copyClaimUrl = () => {
    if (selectedApplication.value?.claim_url) {
        navigator.clipboard.writeText(selectedApplication.value.claim_url)
        alert('領取連結已複製到剪貼簿')
    }
}

// 取得狀態顏色
const getStatusColor = (status) => {
    switch (status) {
        case 'pending':
            return 'warning'
        case 'approved':
            return 'success'
        case 'rejected':
            return 'error'
        default:
            return 'grey'
    }
}

onMounted(() => {
    loadApplications()
    loadStatistics()
})
</script>

<style scoped>
.admin-visitor-parking-page {
    padding: 24px;
}
</style>
