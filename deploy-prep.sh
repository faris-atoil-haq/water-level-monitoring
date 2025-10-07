#!/bin/bash

echo "🚀 Preparing Laravel app for Vercel deployment..."

# Generate application key if not exists
if [ -z "$APP_KEY" ]; then
    echo "📝 Generating application key..."
    php artisan key:generate --show
    echo "⚠️  Copy the above key to your Vercel environment variables as APP_KEY"
fi

# Clear and cache configurations for production
echo "🔧 Caching configurations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Check if database connection works
echo "🗄️  Testing database connection..."
php artisan migrate:status

echo "✅ Pre-deployment checks complete!"
echo ""
echo "📋 Next steps:"
echo "1. Push your code to GitHub"
echo "2. Connect GitHub repo to Vercel"
echo "3. Set environment variables in Vercel dashboard"
echo "4. Deploy!"
echo ""
echo "📖 See DEPLOYMENT.md for detailed instructions"