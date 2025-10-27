# CondoHubPro

Una piattaforma di gestione condominale OpenSource sviluppata con Laravel. Questo repository contiene l'applicazione backend + interfaccia costruita con Livewire e le integrazioni standard di Laravel.

## Descrizione

CondoHubPro è pensata per la gestione di condomini, appartamenti, documenti e comunicazioni tra utenti e amministrazione. 

## Tecnologie principali

- PHP 8+ / Laravel
- Livewire
- Vite, Node/NPM 
- Spatie Permission

## Requisiti

- PHP 8.1+
- Composer
- Node.js + npm (per asset)
- MySQL / MariaDB o altro DB supportato da Laravel

## Installazione (dev)

1. Clona il repository

```bash
git clone <repository-url>
cd CondoHubPro
```

2. Installa dipendenze PHP

```bash
composer install
```

3. Copia il file di environment 

```bash
cp .env.example .env
# Modifica .env con le impostazioni del database e altre chiavi
php artisan key:generate
```

4. Esegui le migration e i seeder per i ruoli (opzionale per gli altri)

```bash
php artisan migrate --seed
```

5. Crea il link per lo storage 

```bash
php artisan storage:link
```

6. Installa dependency frontend e compila gli asset

```bash
npm install
npm run dev
```

7. Avvia il server locale

```bash
php artisan serve
```

## Uso principale

- L'app espone interfacce per amministratori e utenti tramite controller e componenti Livewire.
- Caricamento e gestione documenti (modulo Document) - (in fase di sviluppo).
- Creazione e pubblicazione di avvisi sulla bacheca (NoticeBoard CRUD).
- Gestione appartamenti e condomini con assegnazione utenti.
- Sistema di feedback per raccogliere segnalazioni dagli inquilini.

## Prossime funzionalità in arrivo
- Gestione dei documenti.
- Chat in real time per comunicare tra condomini e amministratore.
- Bot AI.

## Sezione screenshot

[Dashboard](/assets/imgs/screenshots/Screenshot 2025-10-24 180928.png)
[Dashboard](/assets/imgs/screenshots/Screenshot 2025-10-24 180953.png)
[Dashboard](/assets/imgs/screenshots/Screenshot 2025-10-24 181159.png)
[Dashboard](/assets/imgs/screenshots/Screenshot 2025-10-24 181214.pn)
[Dashboard](/assets/imgs/screenshots/Screenshot 2025-10-24 181224.png)
[Dashboard](/assets/imgs/screenshots/Screenshot 2025-10-24 181250.png)
[Dashboard](/assets/imgs/screenshots/Screenshot 2025-10-25 112731.png)

## Contribuire

- Apri una issue per proporre miglioramenti o segnalare bug.
- Per modifiche più estese, crea una branch feature e apri una pull request su `main`.

## Licenza

Il progetto è tutalmente free Open Source

## Ringraziamenti

Seguimi e lascia una recensione. Grazie mille da Salvatore Pitanza
 

 
