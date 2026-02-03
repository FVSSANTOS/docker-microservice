#!/bin/bash

echo "🚀 Iniciando microserviços..."

# Verificar se o arquivo .env existe
if [ ! -f .env ]; then
    echo "⚠️  Arquivo .env não encontrado. Criando a partir do .env.example..."
    cp .env.example .env
    echo "✅ Arquivo .env criado. Por favor, edite com suas configurações."
fi

# Construir e iniciar os serviços
docker-compose up -d --build

echo "⏳ Aguardando serviços iniciarem..."
sleep 10

# Verificar status dos serviços
echo "📊 Status dos serviços:"
docker-compose ps

echo ""
echo "✅ Microserviços iniciados!"
echo ""
echo "📍 Endpoints disponíveis:"
echo "   - API Gateway: http://localhost:4500"
echo "   - Prometheus:  http://localhost:9090"
echo "   - Grafana:     http://localhost:3000 (admin/admin)"
echo "   - MySQL:       localhost:3306"
echo "   - Redis:       localhost:6379"
