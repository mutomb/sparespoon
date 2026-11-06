# SpareSpoon 🥕

**A hyper-local food-sharing shelf for your street.**

SpareSpoon is a small Laravel community marketplace for passing on food you won't get through — a garden glut, half a loaf, a pantry duplicate, or the bag of lemons you bought twice. Neighbors list what they have, browse what's available around the corner, and arrange a simple porch or doorstep pickup.

No fees. No complicated checkout. Just less waste and more sharing.

![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=flat-square&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3-8BC0D0?style=flat-square&logo=alpinedotjs&logoColor=white)
![Pest](https://img.shields.io/badge/Pest-5-22C55E?style=flat-square)

---

## Features

- **Neighbor Accounts:** Complete custom authentication flow built on Laravel's core auth services (no starter kit bloat). Includes login throttling limited to 6 attempts per minute.
- **Neighborhood-Aware Feed:** Automatically scopes available listings to the neighbor's neighborhood or postal code using clean, privacy-first database indexing.
- **Listing Lifecycle:** Multi-state management panel allowing listing owners to toggle items between `Available`, `Reserved`, and `Completed`.
- **Location Anonymity:** Intentionally bypasses geocoding, third-party coordinate tracking, and map APIs. A neighborhood string and postal code are enough to establish a trusted swap point.
- **Mobile-First Layout:** Responsive user experience matching touch-friendly constraints, structured using semantic Blade architectural landmarks.

---

## Main Technologies

- **Framework:** Laravel 13 (Monolith structure)
- **Language:** PHP 8.3+ (Utilizing string-backed Enums for type safety)
- **Frontend:** Blade Components, Tailwind CSS v4, Vite 8
- **Database:** SQLite (Local development default), PostgreSQL/MySQL compatible
- **Testing Suite:** Pest 5 with explicit request coverage

---

## Getting Started

### Prerequisites

- PHP 8.3+
- Composer
- Node.js & npm

### Installation Option A: Using Laravel Herd (Recommended)

1. **Clone the repository into your Herd directory:**
   ```bash
   cd %USERPROFILE%\Herd
   git clone <your-repository-url> sparespoon
   cd sparespoon
   ```

2. **Install project dependencies:**
   ```bash
   herd composer install
   npm install
   ```

3. **Configure environment settings:**
   ```bash
   cp .env.example .env
   herd php artisan key:generate
   ```

4. **Prepare the local database:**
   ```bash
   touch database/database.sqlite
   herd php artisan migrate --seed
   ```

5. **Compile project assets:**
   ```bash
   npm run build
   ```

6. **Access the application:**
   The site is automatically served locally via Herd at:  
   `http://sparespoon.test`

---

### Installation Option B: Using the Standard Artisan Server

1. **Clone the repository:**
   ```bash
   git clone <your-repository-url> sparespoon
   cd sparespoon
   ```

2. **Install project dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment settings:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Prepare the local database:**
   ```bash
   touch database/database.sqlite
   php artisan migrate --seed
   ```

5. **Compile project assets:**
   ```bash
   npm run build
   ```

6. **Serve the application:**
   ```bash
   php artisan serve
   ```
   Open the application interface environment locally at:  
   `http://localhost:8000`

---

## Demo Account

The local seeder configures a fictional test neighborhood to make the local preview experience useful immediately:

- **Email:** `test@example.com`
- **Password:** `password`

---

## Running Tests

Automated feature coverage validates registration integrity, policy authorization blocks, location searches, and state transformations:

```bash
php artisan test
```

---

## Security & Privacy

- **Data Minimization:** No personal contact numbers, street lines, tracking pixels, or structural coordinates are requested or stored.
- **Server-Side Rules:** Resource changes utilize dedicated `ListingPolicy` layers instead of relying solely on hidden frontend buttons.
- **CSRF & Session Security:** Session tokens are natively rotated during identity switches to block common vectors.