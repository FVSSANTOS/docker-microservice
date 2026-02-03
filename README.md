# 🐳 Projeto de Microserviços com Docker

Projeto robusto de microserviços utilizando Docker, Docker Compose, Nginx, PHP, MySQL, Redis, Prometheus e Grafana.

## 📋 Características

- ✅ **Orquestração**: Docker Compose para gerenciar múltiplos serviços
- ✅ **Load Balancing**: Nginx como API Gateway com balanceamento de carga
- ✅ **Health Checks**: Verificação automática de saúde dos serviços
- ✅ **Monitoramento**: Prometheus + Grafana para métricas e visualização
- ✅ **Cache**: Redis para cache e sessões
- ✅ **Variáveis de Ambiente**: Configuração flexível via .env
- ✅ **Logging**: Sistema de logs centralizado
- ✅ **Segurança**: Prepared statements e configurações seguras
- ✅ **Escalabilidade**: Múltiplas instâncias de serviços PHP

## 🏗️ Arquitetura

```
┌─────────────────┐
│   Nginx Gateway │ (Porta 4500)
│  (Load Balancer)│
└────────┬────────┘
         │
    ┌────┴────┬──────────┐
    │         │          │
┌───▼───┐ ┌──▼───┐ ┌───▼───┐
│ PHP-1 │ │ PHP-2│ │ PHP-3 │
└───┬───┘ └──┬───┘ └───┬───┘
    │        │         │
    └────────┴─────────┘
             │
      ┌──────▼──────┐
      │   MySQL     │
      │  (Database) │
      └─────────────┘
```

## 🚀 Como Usar

### Pré-requisitos

- Docker
- Docker Compose

### Instalação

1. Clone o repositório:
```bash
git clone <seu-repositorio>
cd docker-microservice
```

2. Configure as variáveis de ambiente:
```bash
cp .env.example .env
# Edite o arquivo .env com suas configurações
```

3. Inicie os serviços:

**Linux/Mac:**
```bash
chmod +x scripts/*.sh
./scripts/start.sh
```

**Windows (PowerShell):**
```bash
docker-compose up -d --build
```

### Comandos Úteis

```bash
# Iniciar serviços
docker-compose up -d

# Parar serviços
docker-compose down

# Ver logs
docker-compose logs -f [nome-do-servico]

# Ver status dos serviços
docker-compose ps

# Reconstruir serviços
docker-compose up -d --build

# Parar e remover volumes (limpar dados)
docker-compose down -v
```

## 📊 Serviços e Portas

| Serviço | Porta | Descrição |
|---------|-------|-----------|
| Nginx Gateway | 4500 | API Gateway com load balancing |
| MySQL | 3306 | Banco de dados |
| Redis | 6379 | Cache e sessões |
| Prometheus | 9090 | Coleta de métricas |
| Grafana | 3000 | Visualização de métricas |

## 🔍 Health Checks

Cada serviço possui endpoints de health check:

- **Nginx Gateway**: `http://localhost:4500/health`
- **PHP Services**: `http://localhost:4500/health.php`

## 📈 Monitoramento

### Prometheus
- URL: http://localhost:9090
- Coleta métricas de todos os serviços

### Grafana
- URL: http://localhost:3000
- Usuário padrão: `admin`
- Senha padrão: `admin` (configurável via .env)

## 🔒 Segurança

- ✅ Variáveis de ambiente para credenciais
- ✅ Prepared statements no PHP (proteção SQL Injection)
- ✅ Network isolada entre serviços
- ✅ Health checks para detecção de falhas
- ✅ Restart policies configuradas

## 📁 Estrutura do Projeto

```
.
├── docker-compose.yml      # Orquestração dos serviços
├── dockerfile.php          # Dockerfile para serviços PHP
├── dockerfile.nginx        # Dockerfile para Nginx Gateway
├── nginx.conf              # Configuração do Nginx
├── index.php               # Aplicação PHP principal
├── health.php              # Endpoint de health check PHP
├── banco.sql               # Script de inicialização do banco
├── .env.example           # Exemplo de variáveis de ambiente
├── monitoring/            # Configurações de monitoramento
│   ├── prometheus.yml
│   └── grafana/
│       ├── datasources/
│       └── dashboards/
└── scripts/               # Scripts auxiliares
    ├── start.sh
    ├── stop.sh
    └── logs.sh
```

## 🛠️ Melhorias Implementadas

1. **Docker Compose**: Orquestração completa de múltiplos serviços
2. **Health Checks**: Verificação automática de saúde
3. **Load Balancing**: Distribuição inteligente de carga
4. **Monitoramento**: Prometheus + Grafana integrados
5. **Cache**: Redis para melhor performance
6. **Variáveis de Ambiente**: Configuração flexível
7. **Logging**: Sistema de logs estruturado
8. **Segurança**: Prepared statements e network isolation
9. **Escalabilidade**: Múltiplas instâncias de serviços
10. **Restart Policies**: Recuperação automática de falhas

## 📝 Próximos Passos Sugeridos

- [ ] Adicionar testes automatizados
- [ ] Implementar CI/CD pipeline
- [ ] Adicionar autenticação/autorização
- [ ] Implementar circuit breaker
- [ ] Adicionar service discovery
- [ ] Configurar HTTPS/TLS
- [ ] Implementar rate limiting
- [ ] Adicionar documentação da API (Swagger/OpenAPI)

## 🤝 Contribuindo

Sinta-se à vontade para contribuir com melhorias!

## 📄 Licença

Este projeto é parte de um curso da Digital Innovation One.
