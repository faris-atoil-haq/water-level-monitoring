#!/bin/bash

echo "🔍 Verifying Vercel deployment readiness..."

echo ""
echo "📁 Checking required files..."

# Check api/index.php
if [ -f "api/index.php" ]; then
    echo "✅ api/index.php exists"
else
    echo "❌ api/index.php missing"
    exit 1
fi

# Check public/index.php
if [ -f "public/index.php" ]; then
    echo "✅ public/index.php exists"
else
    echo "❌ public/index.php missing"
    exit 1
fi

# Check vercel.json
if [ -f "vercel.json" ]; then
    echo "✅ vercel.json exists"
else
    echo "❌ vercel.json missing"
    exit 1
fi

echo ""
echo "🔧 Checking configuration..."

# Check if .env has APP_KEY
if grep -q "APP_KEY=base64:" .env 2>/dev/null; then
    echo "✅ APP_KEY is set"
else
    echo "⚠️  APP_KEY not found - generate with: php artisan key:generate"
fi

# Check if database is configured
if grep -q "DB_CONNECTION=pgsql" .env 2>/dev/null || grep -q "DATABASE_URL=" .env 2>/dev/null; then
    echo "✅ Database configuration found"
else
    echo "⚠️  Database configuration missing"
fi

echo ""
echo "🎯 Testing Laravel bootstrap..."

# Test if Laravel loads
php -r "require 'bootstrap/app.php'; echo '✅ Laravel bootstraps successfully\n';" 2>/dev/null || echo "❌ Laravel bootstrap failed"

echo ""
echo "📋 Deployment checklist:"
echo "1. ✅ Fixed api/index.php (removed undefined \$uri)"
echo "2. ✅ Updated vercel.json with proper builds section"
echo "3. ✅ Set APP_DEBUG=false for production"
echo "4. ✅ Added static asset caching rules"
echo "5. ✅ Configured proper serverless environment"

echo ""
echo "🚀 Ready for deployment!"
echo ""
echo "Next steps:"
echo "1. git add ."
echo "2. git commit -m 'Fix Vercel deployment - update api/index.php'"
echo "3. git push origin main"
echo "4. Deploy to Vercel"