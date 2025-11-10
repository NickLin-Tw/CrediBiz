# 競賽合規檢測報告

本目錄存放「數位憑證場景創新賽」所需的合規檢測報告。

## 檔案說明

- `sbom-composer.json` - PHP 套件清單 (SBOM)
- `sbom-npm.json` - NPM 套件清單 (SBOM)
- `licenses.json` - 授權條款清單
- `security-deps.txt` - 依賴套件安全檢測報告
- `security-code.txt` - 程式碼靜態分析報告

## 生成報告

執行以下指令生成所有合規檢測報告：

```bash
composer compliance:check
```

## 檢測標準

根據競賽規定，本專案須通過：
1. 無中度至高度風險 (medium-high 以上) 之漏洞
2. 確認所有依賴套件的開源授權
3. 生成完整的 SBOM 檔案
