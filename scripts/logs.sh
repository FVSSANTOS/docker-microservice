#!/bin/bash

if [ -z "$1" ]; then
    echo "📋 Visualizando logs de todos os serviços..."
    docker-compose logs -f
else
    echo "📋 Visualizando logs do serviço: $1"
    docker-compose logs -f "$1"
fi
