<template>
    <v-app>
        <v-app-bar color="primary" elevation="2">
            <v-btn icon @click="$router.push({ name: 'AdminDashboard' })">
                <v-icon>mdi-arrow-left</v-icon>
            </v-btn>
            <v-app-bar-title class="text-h5 font-weight-bold">
                <v-icon class="mr-2">mdi-api</v-icon>
                TW-DIW API Logs
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
                    <v-col cols="12" md="2">
                        <v-card elevation="2">
                            <v-card-text class="text-center">
                                <v-icon size="32" color="primary">mdi-api</v-icon>
                                <div class="text-h6 mt-2">{{ statistics.total }}</div>
                                <div class="text-caption">總呼叫數</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="2">
                        <v-card elevation="2">
                            <v-card-text class="text-center">
                                <v-icon size="32" color="success">mdi-check-circle</v-icon>
                                <div class="text-h6 mt-2">{{ statistics.success }}</div>
                                <div class="text-caption">成功</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="2">
                        <v-card elevation="2">
                            <v-card-text class="text-center">
                                <v-icon size="32" color="error">mdi-close-circle</v-icon>
                                <div class="text-h6 mt-2">{{ statistics.failed }}</div>
                                <div class="text-caption">失敗</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="2">
                        <v-card elevation="2">
                            <v-card-text class="text-center">
                                <v-icon size="32" color="blue">mdi-certificate</v-icon>
                                <div class="text-h6 mt-2">{{ statistics.issuer_calls }}</div>
                                <div class="text-caption">Issuer</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="2">
                        <v-card elevation="2">
                            <v-card-text class="text-center">
                                <v-icon size="32" color="purple">mdi-shield-check</v-icon>
                                <div class="text-h6 mt-2">{{ statistics.verifier_calls }}</div>
                                <div class="text-caption">Verifier</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="2">
                        <v-card elevation="2">
                            <v-card-text class="text-center">
                                <v-icon size="32" color="orange">mdi-timer</v-icon>
                                <div class="text-h6 mt-2">{{ Math.round(statistics.avg_duration_ms) }}ms</div>
                                <div class="text-caption">平均時長</div>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>

                <!-- 篩選 -->
                <v-card class="mb-4" elevation="2">
                    <v-card-text>
                        <v-row>
                            <v-col cols="12" md="2">
                                <v-select
                                    v-model="filters.service"
                                    label="服務"
                                    :items="serviceOptions"
                                    clearable
                                    @update:model-value="loadLogs"
                                />
                            </v-col>
                            <v-col cols="12" md="2">
                                <v-select
                                    v-model="filters.method"
                                    label="HTTP 方法"
                                    :items="methodOptions"
                                    clearable
                                    @update:model-value="loadLogs"
                                />
                            </v-col>
                            <v-col cols="12" md="2">
                                <v-select
                                    v-model="filters.success"
                                    label="狀態"
                                    :items="successOptions"
                                    @update:model-value="loadLogs"
                                />
                            </v-col>
                            <v-col cols="12" md="3">
                                <v-text-field
                                    v-model="filters.endpoint"
                                    label="Endpoint"
                                    prepend-inner-icon="mdi-api"
                                    clearable
                                    @update:model-value="loadLogs"
                                />
                            </v-col>
                            <v-col cols="12" md="3">
                                <v-text-field
                                    v-model="filters.transaction_id"
                                    label="Transaction ID"
                                    prepend-inner-icon="mdi-identifier"
                                    clearable
                                    @update:model-value="loadLogs"
                                />
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>

                <!-- API Logs 列表 -->
                <v-card elevation="2">
                    <v-card-title>
                        API Logs
                        <v-spacer />
                        <v-btn
                            color="primary"
                            size="small"
                            @click="loadLogs"
                        >
                            <v-icon start>mdi-refresh</v-icon>
                            重新載入
                        </v-btn>
                    </v-card-title>

                    <v-data-table
                        :headers="headers"
                        :items="logs"
                        :loading="loading"
                        class="elevation-1"
                        density="compact"
                    >
                        <template #item.service="{ item }">
                            <v-chip
                                :color="item.service === 'issuer' ? 'blue' : 'purple'"
                                size="small"
                            >
                                {{ item.service }}
                            </v-chip>
                        </template>

                        <template #item.method="{ item }">
                            <v-chip
                                :color="getMethodColor(item.method)"
                                size="small"
                            >
                                {{ item.method }}
                            </v-chip>
                        </template>

                        <template #item.success="{ item }">
                            <v-chip
                                :color="item.success ? 'success' : 'error'"
                                size="small"
                            >
                                {{ item.success ? '成功' : '失敗' }}
                            </v-chip>
                        </template>

                        <template #item.response_status="{ item }">
                            <v-chip
                                :color="getStatusColor(item.response_status)"
                                size="small"
                            >
                                {{ item.response_status || 'N/A' }}
                            </v-chip>
                        </template>

                        <template #item.duration_ms="{ item }">
                            <span :class="getDurationClass(item.duration_ms)">
                                {{ item.duration_ms }}ms
                            </span>
                        </template>

                        <template #item.created_at="{ item }">
                            {{ formatDate(item.created_at) }}
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
                        </template>
                    </v-data-table>
                </v-card>

                <!-- 詳情對話框 -->
                <v-dialog v-model="detailsDialog" max-width="900" scrollable>
                    <v-card v-if="selectedLog">
                        <v-card-title class="bg-primary">
                            <v-icon class="mr-2">mdi-api</v-icon>
                            API Log 詳情
                            <v-spacer />
                            <v-chip :color="selectedLog.success ? 'success' : 'error'">
                                {{ selectedLog.success ? '成功' : '失敗' }}
                            </v-chip>
                        </v-card-title>

                        <v-divider />

                        <v-card-text class="pa-6" style="max-height: 600px;">
                            <!-- 基本資訊 -->
                            <h3 class="text-h6 mb-3">基本資訊</h3>
                            <v-row>
                                <v-col cols="6">
                                    <div class="mb-2"><strong>服務：</strong>{{ selectedLog.service }}</div>
                                    <div class="mb-2"><strong>HTTP 方法：</strong>{{ selectedLog.method }}</div>
                                    <div class="mb-2"><strong>Endpoint：</strong><code>{{ selectedLog.endpoint }}</code></div>
                                </v-col>
                                <v-col cols="6">
                                    <div class="mb-2"><strong>狀態碼：</strong>{{ selectedLog.response_status || 'N/A' }}</div>
                                    <div class="mb-2"><strong>執行時間：</strong>{{ selectedLog.duration_ms }}ms</div>
                                    <div class="mb-2"><strong>時間：</strong>{{ formatDate(selectedLog.created_at) }}</div>
                                </v-col>
                            </v-row>

                            <div class="mb-2">
                                <strong>完整 URL：</strong>
                                <code class="text-caption">{{ selectedLog.full_url }}</code>
                            </div>

                            <div v-if="selectedLog.transaction_id" class="mb-2">
                                <strong>Transaction ID：</strong>
                                <code>{{ selectedLog.transaction_id }}</code>
                            </div>

                            <v-divider class="my-4" />

                            <!-- Request Headers -->
                            <h3 class="text-h6 mb-3">Request Headers</h3>
                            <v-card variant="outlined" class="mb-4">
                                <v-card-text>
                                    <pre class="log-content">{{ formatJson(selectedLog.request_headers) }}</pre>
                                </v-card-text>
                            </v-card>

                            <!-- Request Body -->
                            <h3 class="text-h6 mb-3">Request Body</h3>
                            <v-card variant="outlined" class="mb-4">
                                <v-card-text>
                                    <pre class="log-content">{{ formatJson(selectedLog.request_body) }}</pre>
                                </v-card-text>
                            </v-card>

                            <v-divider class="my-4" />

                            <!-- Response Headers -->
                            <h3 class="text-h6 mb-3">Response Headers</h3>
                            <v-card variant="outlined" class="mb-4">
                                <v-card-text>
                                    <pre class="log-content">{{ formatJson(selectedLog.response_headers) }}</pre>
                                </v-card-text>
                            </v-card>

                            <!-- Response Body -->
                            <h3 class="text-h6 mb-3">Response Body</h3>
                            <v-card variant="outlined" class="mb-4">
                                <v-card-text>
                                    <pre class="log-content">{{ formatJson(selectedLog.response_body) }}</pre>
                                </v-card-text>
                            </v-card>

                            <!-- Error Message -->
                            <div v-if="selectedLog.error_message">
                                <h3 class="text-h6 mb-3 text-error">Error Message</h3>
                                <v-alert type="error" variant="outlined">
                                    {{ selectedLog.error_message }}
                                </v-alert>
                            </div>
                        </v-card-text>

                        <v-divider />

                        <v-card-actions>
                            <v-spacer />
                            <v-btn color="grey" variant="text" @click="detailsDialog = false">
                                關閉
                            </v-btn>
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
const logs = ref([])
const statistics = ref({
    total: 0,
    success: 0,
    failed: 0,
    issuer_calls: 0,
    verifier_calls: 0,
    avg_duration_ms: 0,
})

const filters = ref({
    service: null,
    method: null,
    success: null,
    endpoint: '',
    transaction_id: ''
})

const serviceOptions = [
    { title: 'Issuer', value: 'issuer' },
    { title: 'Verifier', value: 'verifier' }
]

const methodOptions = [
    { title: 'GET', value: 'GET' },
    { title: 'POST', value: 'POST' },
    { title: 'PUT', value: 'PUT' },
    { title: 'DELETE', value: 'DELETE' }
]

const successOptions = [
    { title: '全部', value: null },
    { title: '成功', value: true },
    { title: '失敗', value: false }
]

const headers = [
    { title: '服務', key: 'service', width: '80px' },
    { title: '方法', key: 'method', width: '80px' },
    { title: 'Endpoint', key: 'endpoint' },
    { title: '狀態碼', key: 'response_status', width: '80px' },
    { title: '結果', key: 'success', width: '80px' },
    { title: '時長', key: 'duration_ms', width: '100px' },
    { title: '時間', key: 'created_at' },
    { title: '操作', key: 'actions', sortable: false, width: '100px' }
]

const detailsDialog = ref(false)
const selectedLog = ref(null)

const snackbar = ref(false)
const snackbarText = ref('')
const snackbarColor = ref('success')

const loadStatistics = async () => {
    try {
        const response = await axios.get('/api/admin/api-logs/statistics')
        statistics.value = response.data.statistics
    } catch (error) {
        console.error(error)
    }
}

const loadLogs = async () => {
    loading.value = true
    try {
        const params = {}
        if (filters.value.service) params.service = filters.value.service
        if (filters.value.method) params.method = filters.value.method
        if (filters.value.success !== null) params.success = filters.value.success
        if (filters.value.endpoint) params.endpoint = filters.value.endpoint
        if (filters.value.transaction_id) params.transaction_id = filters.value.transaction_id

        const response = await axios.get('/api/admin/api-logs', { params })
        logs.value = response.data.logs.data || response.data.logs
    } catch (error) {
        showSnackbar('載入 API Logs 失敗', 'error')
        console.error(error)
    } finally {
        loading.value = false
    }
}

const viewDetails = (log) => {
    selectedLog.value = log
    detailsDialog.value = true
}

const getMethodColor = (method) => {
    const colors = {
        GET: 'blue',
        POST: 'green',
        PUT: 'orange',
        DELETE: 'red'
    }
    return colors[method] || 'grey'
}

const getStatusColor = (status) => {
    if (!status) return 'grey'
    if (status >= 200 && status < 300) return 'success'
    if (status >= 400 && status < 500) return 'warning'
    if (status >= 500) return 'error'
    return 'grey'
}

const getDurationClass = (duration) => {
    if (duration > 2000) return 'text-error font-weight-bold'
    if (duration > 1000) return 'text-warning font-weight-bold'
    return ''
}

const formatDate = (dateString) => {
    if (!dateString) return ''
    return new Date(dateString).toLocaleString('zh-TW')
}

const formatJson = (data) => {
    if (!data) return 'null'
    if (typeof data === 'string') {
        try {
            return JSON.stringify(JSON.parse(data), null, 2)
        } catch (e) {
            return data
        }
    }
    return JSON.stringify(data, null, 2)
}

const showSnackbar = (text, color = 'success') => {
    snackbarText.value = text
    snackbarColor.value = color
    snackbar.value = true
}

onMounted(() => {
    loadStatistics()
    loadLogs()
})
</script>

<style scoped>
.bg-grey-lighten-4 {
    background-color: #f5f5f5;
}

.log-content {
    font-size: 12px;
    line-height: 1.4;
    max-height: 300px;
    overflow: auto;
    background-color: #f5f5f5;
    padding: 12px;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
}
</style>
