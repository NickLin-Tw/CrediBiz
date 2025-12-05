<template>
    <v-app>
        <v-app-bar color="primary" elevation="2">
            <v-btn icon @click="$router.push({ name: 'AdminDashboard' })">
                <v-icon>mdi-arrow-left</v-icon>
            </v-btn>
            <v-app-bar-title class="text-h5 font-weight-bold">
                <v-icon class="mr-2">mdi-account-group</v-icon>
                員工管理
            </v-app-bar-title>
            <v-spacer />
            <v-btn icon @click="$router.push({ name: 'Home' })">
                <v-icon>mdi-home</v-icon>
            </v-btn>
        </v-app-bar>

        <v-main class="bg-grey-lighten-4">
            <v-container fluid class="pa-6">
                <!-- 搜尋與篩選 -->
                <v-card class="mb-4" elevation="2">
                    <v-card-text>
                        <v-row>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    v-model="filters.search"
                                    label="搜尋員工"
                                    prepend-inner-icon="mdi-magnify"
                                    placeholder="員工編號、姓名、部門..."
                                    clearable
                                    @update:model-value="loadEmployees"
                                />
                            </v-col>
                            <v-col cols="12" md="2">
                                <v-select
                                    v-model="filters.isActive"
                                    label="在職狀態"
                                    :items="[
                                        { title: '全部', value: null },
                                        { title: '在職', value: true },
                                        { title: '離職', value: false }
                                    ]"
                                    @update:model-value="loadEmployees"
                                />
                            </v-col>
                            <v-col cols="12" md="2">
                                <v-select
                                    v-model="filters.hasCredential"
                                    label="憑證狀態"
                                    :items="[
                                        { title: '全部', value: null },
                                        { title: '已發放', value: true },
                                        { title: '未發放', value: false }
                                    ]"
                                    @update:model-value="loadEmployees"
                                />
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>

                <!-- 員工列表 -->
                <v-card elevation="2">
                    <v-card-title class="d-flex align-center">
                        <span>員工列表</span>
                        <v-spacer />
                        <v-chip class="mr-2" color="primary">
                            總計：{{ employees.length }} 人
                        </v-chip>
                    </v-card-title>

                    <v-data-table
                        :headers="headers"
                        :items="employees"
                        :loading="loading"
                        class="elevation-1"
                    >
                        <template #item.is_active="{ item }">
                            <v-chip :color="item.is_active ? 'success' : 'grey'" size="small">
                                {{ item.is_active ? '在職' : '離職' }}
                            </v-chip>
                        </template>

                        <template #item.employee_vc_cid="{ item }">
                            <v-chip v-if="item.employee_vc_cid" color="success" size="small">
                                <v-icon start size="small">mdi-certificate</v-icon>
                                已發放
                            </v-chip>
                            <v-chip v-else color="grey" size="small">
                                未發放
                            </v-chip>
                        </template>

                        <template #item.actions="{ item }">
                            <v-btn
                                size="small"
                                color="primary"
                                variant="text"
                                @click="viewEmployee(item)"
                            >
                                詳情
                            </v-btn>
                            <v-btn
                                v-if="item.is_active"
                                size="small"
                                color="error"
                                variant="text"
                                @click="openResignDialog(item)"
                            >
                                離職
                            </v-btn>
                        </template>
                    </v-data-table>
                </v-card>

                <!-- 員工詳情對話框 -->
                <v-dialog v-model="employeeDialog" max-width="800">
                    <v-card v-if="selectedEmployee">
                        <v-card-title class="text-h5">
                            <v-icon class="mr-2">mdi-account</v-icon>
                            {{ selectedEmployee.name }} ({{ selectedEmployee.employee_id }})
                        </v-card-title>

                        <v-divider />

                        <v-card-text>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <div class="mb-2"><strong>部門：</strong>{{ selectedEmployee.department }}</div>
                                    <div class="mb-2"><strong>職位：</strong>{{ selectedEmployee.position }}</div>
                                    <div class="mb-2"><strong>公司：</strong>{{ selectedEmployee.company_name }}</div>
                                    <div class="mb-2"><strong>到職日：</strong>{{ selectedEmployee.employment_start_date }}</div>
                                </v-col>
                                <v-col cols="12" md="6">
                                    <div class="mb-2">
                                        <strong>在職狀態：</strong>
                                        <v-chip :color="selectedEmployee.is_active ? 'success' : 'grey'" size="small">
                                            {{ selectedEmployee.is_active ? '在職' : '離職' }}
                                        </v-chip>
                                    </div>
                                    <div v-if="selectedEmployee.employee_vc_cid" class="mb-2">
                                        <strong>憑證 CID：</strong>
                                        <code class="text-caption">{{ selectedEmployee.employee_vc_cid }}</code>
                                    </div>
                                    <div v-if="selectedEmployee.employee_vc_expiry_date" class="mb-2">
                                        <strong>憑證到期：</strong>{{ selectedEmployee.employee_vc_expiry_date }}
                                    </div>
                                </v-col>
                            </v-row>

                            <v-divider class="my-4" />

                            <h3 class="text-h6 mb-3">VC 管理</h3>
                            <v-row>
                                <v-col cols="12" md="4">
                                    <v-btn
                                        block
                                        color="warning"
                                        :disabled="!selectedEmployee.employee_vc_cid"
                                        @click="revokeVC(selectedEmployee)"
                                    >
                                        <v-icon start>mdi-cancel</v-icon>
                                        撤銷憑證
                                    </v-btn>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-btn
                                        block
                                        color="primary"
                                        @click="reissueVC(selectedEmployee)"
                                    >
                                        <v-icon start>mdi-refresh</v-icon>
                                        換發憑證
                                    </v-btn>
                                </v-col>
                            </v-row>

                            <v-divider class="my-4" />

                            <h3 class="text-h6 mb-3">已發行憑證列表</h3>
                            <v-list v-if="employeeVCs.length > 0">
                                <v-list-item v-for="vc in employeeVCs" :key="vc.id">
                                    <v-list-item-title>
                                        <code>{{ vc.vc_cid }}</code>
                                        <v-chip
                                            class="ml-2"
                                            :color="vc.is_revoked ? 'error' : 'success'"
                                            size="small"
                                        >
                                            {{ vc.is_revoked ? '已撤銷' : '有效' }}
                                        </v-chip>
                                    </v-list-item-title>
                                    <v-list-item-subtitle>
                                        VC UID: {{ vc.vc_uid }} | 發行時間: {{ formatDate(vc.created_at) }}
                                    </v-list-item-subtitle>
                                </v-list-item>
                            </v-list>
                            <v-alert v-else type="info">尚無憑證記錄</v-alert>
                        </v-card-text>

                        <v-divider />

                        <v-card-actions>
                            <v-spacer />
                            <v-btn color="grey" variant="text" @click="employeeDialog = false">
                                關閉
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>

                <!-- 撤銷憑證對話框 -->
                <v-dialog v-model="revokeDialog" max-width="500">
                    <v-card>
                        <v-card-title>撤銷憑證</v-card-title>
                        <v-card-text>
                            <p>確定要撤銷 <strong>{{ revokeTarget?.name }}</strong> 的憑證嗎？</p>
                            <v-text-field
                                v-model="revokeReason"
                                label="撤銷原因"
                                required
                                class="mt-4"
                            />
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer />
                            <v-btn color="grey" variant="text" @click="revokeDialog = false">取消</v-btn>
                            <v-btn color="error" @click="confirmRevokeVC">確定撤銷</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>

                <!-- 離職對話框 -->
                <v-dialog v-model="resignDialog" max-width="500">
                    <v-card>
                        <v-card-title>員工離職處理</v-card-title>
                        <v-card-text>
                            <p class="mb-4">
                                確定要將 <strong>{{ resignTarget?.name }}</strong> 設為離職嗎？<br>
                                此操作將會撤銷該員工的所有憑證。
                            </p>
                            <v-text-field
                                v-model="resignDate"
                                label="離職日期"
                                type="date"
                                required
                            />
                            <v-textarea
                                v-model="resignReason"
                                label="離職原因"
                                rows="3"
                            />
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer />
                            <v-btn color="grey" variant="text" @click="resignDialog = false">取消</v-btn>
                            <v-btn color="error" @click="confirmResign">確定離職</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>

                <!-- QR Code 對話框（換發憑證） -->
                <v-dialog v-model="qrDialog" max-width="500">
                    <v-card>
                        <v-card-title>掃描 QR Code 領取新憑證</v-card-title>
                        <v-card-text class="text-center">
                            <v-img v-if="qrCodeData" :src="qrCodeData" max-width="300" class="mx-auto" />
                            <p class="mt-4">請員工使用數位皮夾 App 掃描此 QR Code</p>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer />
                            <v-btn color="primary" @click="qrDialog = false">完成</v-btn>
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
const employees = ref([])
const filters = ref({
    search: '',
    isActive: null,
    hasCredential: null
})

const headers = [
    { title: '員工編號', key: 'employee_id', align: 'start' },
    { title: '姓名', key: 'name' },
    { title: '部門', key: 'department' },
    { title: '職位', key: 'position' },
    { title: '在職狀態', key: 'is_active' },
    { title: '憑證狀態', key: 'employee_vc_cid' },
    { title: '操作', key: 'actions', sortable: false }
]

const employeeDialog = ref(false)
const selectedEmployee = ref(null)
const employeeVCs = ref([])

const revokeDialog = ref(false)
const revokeTarget = ref(null)
const revokeReason = ref('')

const resignDialog = ref(false)
const resignTarget = ref(null)
const resignDate = ref(new Date().toISOString().split('T')[0])
const resignReason = ref('')

const qrDialog = ref(false)
const qrCodeData = ref('')

const snackbar = ref(false)
const snackbarText = ref('')
const snackbarColor = ref('success')

const loadEmployees = async () => {
    loading.value = true
    try {
        const params = {}
        if (filters.value.search) params.search = filters.value.search
        if (filters.value.isActive !== null) params.is_active = filters.value.isActive
        if (filters.value.hasCredential !== null) params.has_credential = filters.value.hasCredential

        const response = await axios.get('/api/admin/employees', { params })
        employees.value = response.data.employees.data || response.data.employees
    } catch (error) {
        showSnackbar('載入員工資料失敗', 'error')
        console.error(error)
    } finally {
        loading.value = false
    }
}

const viewEmployee = async (employee) => {
    selectedEmployee.value = employee
    employeeDialog.value = true

    // 載入該員工的所有 VC
    try {
        const response = await axios.get(`/api/admin/employees/${employee.employee_id}`)
        employeeVCs.value = response.data.employee.issued_v_cs || []
    } catch (error) {
        console.error(error)
    }
}

const revokeVC = (employee) => {
    revokeTarget.value = employee
    revokeReason.value = ''
    revokeDialog.value = true
}

const confirmRevokeVC = async () => {
    if (!revokeReason.value) {
        showSnackbar('請輸入撤銷原因', 'warning')
        return
    }

    try {
        await axios.post('/api/admin/employees/revoke-vc', {
            employee_id: revokeTarget.value.employee_id,
            vc_cid: revokeTarget.value.employee_vc_cid,
            reason: revokeReason.value
        })

        showSnackbar('憑證撤銷成功', 'success')
        revokeDialog.value = false
        employeeDialog.value = false
        await loadEmployees()
    } catch (error) {
        showSnackbar('憑證撤銷失敗', 'error')
        console.error(error)
    }
}

const reissueVC = async (employee) => {
    const reason = prompt('請輸入換發原因：')
    if (!reason) return

    try {
        const response = await axios.post('/api/admin/employees/reissue-vc', {
            employee_id: employee.employee_id,
            reason
        })

        qrCodeData.value = response.data.qrCode
        qrDialog.value = true
        employeeDialog.value = false
    } catch (error) {
        showSnackbar('換發憑證失敗', 'error')
        console.error(error)
    }
}

const openResignDialog = (employee) => {
    resignTarget.value = employee
    resignDate.value = new Date().toISOString().split('T')[0]
    resignReason.value = ''
    resignDialog.value = true
}

const confirmResign = async () => {
    if (!resignDate.value) {
        showSnackbar('請選擇離職日期', 'warning')
        return
    }

    try {
        await axios.post('/api/admin/employees/resign', {
            employee_id: resignTarget.value.employee_id,
            resignation_date: resignDate.value,
            resignation_reason: resignReason.value
        })

        showSnackbar('離職處理完成', 'success')
        resignDialog.value = false
        await loadEmployees()
    } catch (error) {
        showSnackbar('離職處理失敗', 'error')
        console.error(error)
    }
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
    loadEmployees()
})
</script>

<style scoped>
.bg-grey-lighten-4 {
    background-color: #f5f5f5;
}
</style>
