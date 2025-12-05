# CrediBiz

> 基於數位憑證（VC/VP）的中小企業人資管理系統

[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)
[![Laravel](https://img.shields.io/badge/Laravel-12.37.0-red.svg)](https://laravel.com)
[![Vue.js](https://img.shields.io/badge/Vue.js-3.5.22-green.svg)](https://vuejs.org)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-18.0.2-blue.svg)](https://www.postgresql.org)

## 📖 專案簡介

**CrediBiz** 是一個參加「數位憑證場景創新賽」的創新專案，展示如何將 **TW-DIW（Taiwan Digital Identity Wallet）數位錢包**整合至中小企業的人力資源管理流程中。

本系統實現了從求職應徵、員工到職到請假申請的完整數位化流程，透過可驗證憑證（Verifiable Credentials）技術，提升企業營運效率並增強資料安全性。

### 主要應用場景

- 🎯 **求職應徵驗證**: 使用數位憑證驗證求職者學歷、證照等資格
- 👔 **員工到職管理**: 發行數位員工證，建立可驗證的員工身分
- 🏥 **請假流程數位化**: 整合醫療診斷證明 VC，自動化請假審核流程

---

## ✨ 功能特色

### 🔐 數位憑證整合

- 完整整合 TW-DIW Issuer/Verifier Sandbox API
- 支援 VC（Verifiable Credential）發行
- 支援 VP（Verifiable Presentation）驗證
- QR Code 掃描流程符合實際使用體驗

### 📋 前置憑證管理

系統提供 4 種數位憑證模擬發行：

1. **中華民國數位身分證** (`00000000_roc_did_vc`)
   - 身分證字號驗證（含檢查碼算法）
   - 民國年格式轉換

2. **學位證書** (`00000000_moe_ndc_vc`)
   - 學歷資格驗證
   - 學位類別（學士/碩士/博士）

3. **多益證書** (`00000000_toeic_vc`)
   - 語言能力證明
   - 成績範圍驗證（0-990）

4. **醫療診斷證明** (`00000000_vc_medical_diagnosis_certificate`) ⭐
   - **可重複申請**（模擬多次就醫）
   - 採用真實 ICD-10 疾病分類代碼
   - 自動計算休養天數與日期
   - 包含心理疾病與生理疾病（15+ 種診斷）

### 👥 人資管理功能

- **員工端功能**:
  - 查看個人數位憑證
  - 線上請假申請
  - 上傳醫療診斷證明 VC
  - 查看請假歷史記錄

- **HR 端功能**:
  - 請假申請審核
  - 驗證醫療診斷證明真實性
  - 員工管理儀表板
  - 請假統計分析

### 🎨 使用者體驗

- 現代化 UI/UX 設計（Vuetify 3）
- 響應式介面適配各種裝置
- 自動填入範例資料（快速測試）
- 即時欄位驗證與錯誤提示
- 完整的中文化介面

---

## 🛠 技術堆疊

### 後端

- **PHP**: 8.5
- **框架**: Laravel 12.37.0
- **資料庫**: PostgreSQL 18.0.2
- **測試**: Pest PHP
- **程式碼品質**: Laravel Pint

### 前端

- **框架**: Vue.js 3.5.22
- **UI 框架**: Vuetify 3.10.9
- **路由**: Vue Router
- **建置工具**: Vite

### 部署

- **容器化**: Docker + Docker Compose
- **Web 伺服器**: Nginx
- **SSL**: Let's Encrypt (自動更新)

### 外部整合

- **TW-DIW Issuer Sandbox**: 憑證發行
- **TW-DIW Verifier Sandbox**: 憑證驗證

---

## 📋 系統需求

- PHP >= 8.5
- PostgreSQL >= 18.0
- Composer
- Node.js >= 18.0
- npm 或 yarn

---

## 🚀 快速開始

### 1. 複製專案

```bash
git clone https://github.com/your-username/credibiz.git
cd credibiz
```

### 2. 安裝依賴套件

```bash
# 安裝 PHP 依賴
composer install

# 安裝 JavaScript 依賴
npm install
```

### 3. 環境設定

```bash
# 複製環境變數檔案
cp .env.example .env

# 產生應用程式金鑰
php artisan key:generate
```

### 4. 設定資料庫

編輯 `.env` 檔案，設定 PostgreSQL 連線資訊：

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. 設定 TW-DIW API Token

在 `.env` 中設定您的 TW-DIW Sandbox Token：

```env
TW_DIW_ISSUER_SANDBOX_TOKEN=your_issuer_token
TW_DIW_VERIFIER_SANDBOX_TOKEN=your_verifier_token
```

### 6. 執行資料庫遷移

```bash
php artisan migrate
```

### 7. 啟動開發環境

使用一鍵啟動指令（推薦）：

```bash
composer dev
```

這會同時啟動：
- Laravel 開發伺服器 (http://127.0.0.1:8000)
- Queue Worker（佇列處理）
- Pail（日誌檢視器）
- Vite（前端熱重載）

或者分別啟動個別服務：

```bash
# Terminal 1: Laravel 伺服器
php artisan serve

# Terminal 2: 前端開發伺服器
npm run dev

# Terminal 3: 佇列處理（選用）
php artisan queue:listen
```

### 8. 開啟瀏覽器

訪問 http://127.0.0.1:8000 開始使用系統

---

## 📁 專案結構

```
CrediBiz/
├── app/
│   ├── Http/
│   │   └── Controllers/      # 控制器
│   ├── Models/               # 資料模型
│   └── Services/             # 業務邏輯服務
├── database/
│   ├── migrations/           # 資料庫遷移
│   └── seeders/              # 測試資料填充
├── resources/
│   ├── js/
│   │   ├── pages/            # Vue 頁面元件
│   │   ├── components/       # Vue 可重用元件
│   │   └── router/           # 路由設定
│   ├── css/                  # 樣式檔案
│   └── views/                # Blade 樣板
├── routes/
│   ├── web.php               # Web 路由
│   └── api.php               # API 路由
├── tests/
│   ├── Feature/              # 功能測試
│   └── Unit/                 # 單元測試
├── compliance/               # 競賽合規報告
├── docker/                   # Docker 設定
└── public/                   # 公開資源
```

---

## 🎮 使用說明

### 求職者流程

1. **首頁**: 瀏覽職位列表
2. **領取前置 VC**:
   - 領取身分證 VC
   - 領取學位證書 VC
   - 領取多益證書 VC
   - （選用）領取醫療診斷證明 VC
3. **應徵職位**: 提交 VP 進行驗證
4. **錄取通知**: 收到錄取通知
5. **領取員工證**: 獲得數位員工證 VC

### 員工流程

1. **登入系統**: 使用員工帳號登入
2. **申請請假**:
   - 上傳醫療診斷證明 VC
   - 填寫請假資訊
   - 提交申請
3. **追蹤狀態**: 查看請假審核狀態

### HR 管理流程

1. **登入管理介面**: 使用 HR 帳號登入
2. **審核請假**:
   - 查看請假申請列表
   - 驗證醫療診斷證明 VC 真實性
   - 核准或拒絕請假
3. **統計分析**: 查看請假統計資料

---

## 🧪 測試

### 執行所有測試

```bash
composer test
# 或
php artisan test
```

### 執行特定測試套件

```bash
# 單元測試
php artisan test --testsuite=Unit

# 功能測試
php artisan test --testsuite=Feature
```

### 執行單一測試檔案

```bash
php artisan test tests/Feature/ExampleTest.php
```

---

## 🔒 安全性與合規

### 競賽合規檢查

本專案完全符合「數位憑證場景創新賽」的所有要求：

```bash
# 執行完整合規檢查
composer compliance:check
```

#### 個別檢查項目

```bash
# 安全性檢查
composer security:deps          # 檢查依賴套件漏洞
composer security:code          # PHPStan 靜態分析

# SBOM 產生
composer compliance:sbom        # PHP SBOM
npm run sbom:generate           # npm SBOM

# 授權檢查
npm run license:check           # 檢查套件授權
```

### 安全性要求

✅ **無中高嚴重性漏洞**
✅ **完整 SBOM（CycloneDX 1.4 格式）**
✅ **授權合規（Apache 2.0 License）**
✅ **靜態程式碼分析通過**

所有合規報告儲存於 `compliance/` 目錄。

---

## 🐳 Docker 部署

### 建置並啟動服務

```bash
docker-compose up -d --build
```

### 初始化 SSL 憑證（首次部署）

```bash
./docker/init-letsencrypt.sh your-domain.com your-email@example.com
```

### 查看服務狀態

```bash
docker-compose ps
```

### 查看日誌

```bash
docker-compose logs -f app
```

### 停止服務

```bash
docker-compose down
```

### Docker 架構

- `postgres`: PostgreSQL 18 資料庫
- `app`: Laravel 應用程式 (PHP-FPM + Nginx + Queue Worker)
- `nginx`: 反向代理伺服器（處理 SSL/TLS）
- `certbot`: Let's Encrypt 憑證自動更新

---

## 🛠 開發工具

### 程式碼格式化

```bash
# 使用 Laravel Pint 格式化程式碼
vendor/bin/pint
```

### 資料庫管理

```bash
# 執行遷移
php artisan migrate

# 回滾遷移
php artisan migrate:rollback

# 重置資料庫
php artisan migrate:fresh

# 填充測試資料
php artisan db:seed
```

### 前端建置

```bash
# 開發模式（熱重載）
npm run dev

# 生產環境建置
npm run build
```

---

## 📊 系統亮點

### 1. 真實場景模擬

完整的企業人資流程，從應徵到到職到請假的閉環設計。

### 2. 政府錢包整合

真實串接 TW-DIW Sandbox，VC 發行與 VP 驗證完整實作。

### 3. 使用者體驗

- 現代化 UI/UX 設計
- 響應式介面
- 自動填入測試資料
- 即時驗證與錯誤提示

### 4. 擴充性設計

- 模組化架構
- 支援多種 VC 類型
- 易於新增其他企業流程

### 5. 開發品質

- 完整的測試覆蓋
- 程式碼風格檢查
- Docker 容器化
- CI/CD 就緒

---

## 🏆 競賽資訊

- **競賽名稱**: 數位憑證場景創新賽
- **場景類別**: 中小企業人資管理
- **技術整合**: TW-DIW (Taiwan Digital Identity Wallet)
- **專案授權**: Apache License 2.0

---

## 📝 授權

本專案採用 [Apache License 2.0](https://opensource.org/licenses/Apache-2.0) 授權。

```
Copyright 2025 CrediBiz Team

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
```

---

## 🙋 常見問題

### Q: 如何取得 TW-DIW Sandbox Token？

A: 請參考 TW-DIW 官方文件申請 Sandbox 測試帳號：
- Issuer Sandbox: https://issuer-sandbox.wallet.gov.tw/
- Verifier Sandbox: https://verifier-sandbox.wallet.gov.tw/

### Q: 醫療診斷證明 VC 可以重複領取嗎？

A: 是的！醫療診斷證明 VC 設計為可重複領取，模擬員工多次就醫的真實情境。

### Q: 系統支援哪些瀏覽器？

A: 支援所有現代瀏覽器（Chrome, Firefox, Safari, Edge）。

### Q: 如何新增其他類型的 VC？

A: 請參考 `app/Http/Controllers/` 中的 VC 控制器實作，並在前端新增對應的頁面元件。

---

## 📞 聯絡資訊

如有任何問題或建議，歡迎透過以下方式聯繫：

- **Issue Tracker**: GitHub Issues
- **Email**: your-email@example.com

---

## 🎯 未來展望

我們計劃在未來版本中加入：

- 🔄 更多 HR 相關憑證（訓練證書、績效評估等）
- 💰 財務相關憑證（薪資證明、在職證明等）
- 🌐 跨企業憑證互認機制
- 🔔 憑證吊銷與更新功能
- 🌍 多語系支援

---

**Made with ❤️ for 數位憑證場景創新賽**
