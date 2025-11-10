#!/bin/bash

# CrediBiz 上傳到 BitBucket 腳本
# 使用前請先在 BitBucket 建立公開 repository

echo "========================================="
echo "CrediBiz 上傳到 BitBucket"
echo "========================================="
echo ""

# 檢查是否已經初始化
if [ -d ".git" ]; then
    echo "⚠️  Git repository 已存在，跳過初始化"
else
    echo "📦 初始化 Git repository..."
    git init
fi

echo ""
echo "📋 檢查即將上傳的檔案..."
git add .
echo ""
git status
echo ""

read -p "❓ 確認以上檔案列表正確？(y/n) " -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Yy]$ ]]
then
    echo "❌ 取消上傳"
    exit 1
fi

echo ""
echo "💾 建立 commit..."
git commit -m "Initial commit for 數位憑證場景創新賽"

echo ""
read -p "請輸入您的 BitBucket repository URL (例: https://bitbucket.org/username/credibiz.git): " REPO_URL

if [ -z "$REPO_URL" ]; then
    echo "❌ 未輸入 URL，取消上傳"
    exit 1
fi

echo ""
echo "🔗 連接到 BitBucket..."
git remote add origin "$REPO_URL" 2>/dev/null || git remote set-url origin "$REPO_URL"

echo ""
echo "🚀 推送到 BitBucket..."
git branch -M main
git push -u origin main

echo ""
echo "========================================="
echo "✅ 上傳完成！"
echo "========================================="
echo ""
echo "請確認以下事項："
echo "1. 在 BitBucket 上確認 repository 已設為公開"
echo "2. 使用無痕模式訪問您的 repository URL 驗證"
echo "3. 確認 .env 和其他敏感檔案沒有被上傳"
echo ""
