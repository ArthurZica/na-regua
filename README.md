# 💈 Na Régua

Sistema web integrado a chatbot para gestão automatizada de barbearias.

O **Na Régua** é uma plataforma SaaS desenvolvida para modernizar a gestão de barbearias de pequeno porte, integrando um sistema web administrativo com um chatbot inteligente no WhatsApp.

Projeto desenvolvido como Trabalho de Conclusão de Curso (TCC) em Sistemas de Informação.

---

## 📌 Problema

Barbearias que utilizam apenas o WhatsApp para agendamentos enfrentam:

- Conflitos de horário  
- Respostas demoradas  
- Dificuldade de organização  
- Sobrecarga do profissional  
- Falta de histórico estruturado  

O Na Régua automatiza e organiza todo esse processo.

---

## 🚀 Solução

A solução integra:

- 🌐 Plataforma Web Administrativa (SaaS)
- 🤖 Chatbot Inteligente no WhatsApp
- 🔄 Sincronização em tempo real
- 🗂 Gestão completa de clientes e agenda

---

## 🏗 Arquitetura

### 🔹 Sistema Web

- PHP (Laravel)
- Arquitetura MVC
- Painel administrativo com Filament
- Banco de dados MySQL
- Cache e memória com Redis
- Arquitetura multi-tenant (multiempresa)

Funcionalidades:

- Cadastro de barbearias
- Cadastro de clientes
- Cadastro de serviços (valor e duração)
- Cadastro de funcionários
- Gerenciamento de agendamentos
- Controle de acesso por papéis (RBAC)

---

### 🔹 Chatbot

- Orquestração com n8n
- Integração via Evolution API (WhatsApp)
- LLM (GPT-4.1 Mini)
- Transcrição de áudio (Google Gemini)
- Memória conversacional com Redis

Capacidades:

- Cadastro automático de cliente
- Consulta de horários disponíveis
- Agendamento
- Reagendamento
- Cancelamento
- Confirmação automática

---

### 🔹 Infraestrutura

- VPS Linux
- Docker
- MySQL
- Redis
- n8n

---

## 🔐 Controle de Acesso (RBAC)

- **Administrador** → Controle total do sistema
- **Gerente** → Gerencia uma ou mais barbearias
- **Barbeiro** → Visualiza e gerencia apenas seus atendimentos

---

## 🔄 Fluxo de Funcionamento

1. Cliente envia mensagem no WhatsApp
2. Webhook recebe evento
3. n8n processa mensagem
4. LLM interpreta intenção
5. Ferramentas HTTP executam ações na API
6. Banco de dados é atualizado
7. Cliente recebe resposta
8. Painel administrativo reflete a alteração em tempo real

---

## 🧪 Metodologia

O projeto foi desenvolvido utilizando **Design Science Research (DSR)**:

1. Identificação do problema
2. Definição dos objetivos
3. Design e desenvolvimento
4. Demonstração em ambiente real
5. Avaliação
6. Comunicação dos resultados

---

## 📊 Resultados da Avaliação

Avaliação preliminar com 13 participantes:

- Facilidade de uso: **4,46 / 5**
- Clareza das respostas: **4,54 / 5**
- Simplicidade do agendamento: **4,92 / 5**
- Confirmação de agendamento: **5,00 / 5**
- Satisfação geral: **9,15 / 10**
- 100% afirmaram que usariam novamente

---
## 🧠 Tecnologias Utilizadas

- PHP
- Laravel
- Filament
- MySQL
- Redis
- n8n
- Docker
- Evolution API (Whatsapp)
- Large Language Models (LLMs)

---

## 🎯 Objetivos

- Reduzir conflitos de agendamento
- Automatizar comunicação com clientes
- Melhorar eficiência operacional
- Demonstrar viabilidade de IA em pequenos negócios
- Oferecer solução escalável no modelo SaaS

---

## 📄 Trabalho Acadêmico

**Desenvolvimento de um sistema Web integrado a chatbot para gestão de barbearias**

Curso: Sistemas de Informação  
Instituição: PUC Minas  
Ano: 2025

Acesso: https://bib.pucminas.br/acervo/571572


