# 패션 가격비교 검색 서비스

패션 아이템의 가격을 여러 쇼핑몰에서 비교할 수 있는 웹 서비스입니다.

**🌐 서비스 URL**: http://price.unwanted.me/

## 📖 프로젝트 개요

국내 주요 패션 쇼핑몰들을 실시간으로 크롤링하여 동일한 제품의 가격 정보를 한눈에 비교할 수 있는 서비스입니다.

### 지원 쇼핑몰
- 무신사 (Musinsa)
- 브랜디 (Brandi)
- 브리치 (Brich)
- 서울스토어 (Seoul Store)
- 29CM

## 🛠️ 기술 스택

- **Backend**: Laravel 8 + Livewire 2.0
- **Frontend**: TailwindCSS + Alpine.js
- **크롤링**: GuzzleHttp + Simple HTML DOM Parser
- **인증**: Laravel Jetstream
- **빌드 도구**: Laravel Mix

## 🚀 설치 및 실행

### 1. 저장소 클론
```bash
git clone [repository-url]
cd price_search
```

### 2. PHP 의존성 설치
```bash
composer install
```

### 3. Node.js 의존성 설치
```bash
npm install
```

### 4. 환경 설정
```bash
cp .env.example .env
php artisan key:generate
```

### 5. 데이터베이스 설정
`.env` 파일에서 데이터베이스 정보를 설정한 후:
```bash
php artisan migrate
```

### 6. 개발 서버 실행
```bash
# Laravel 개발 서버
php artisan serve

# 프론트엔드 에셋 컴파일 (별도 터미널)
npm run dev
# 또는 파일 변경 감지
npm run watch
```

## 📁 프로젝트 구조

```
app/
├── Crawler/                    # 크롤러 시스템
│   ├── AbstractCrawler.php    # 크롤러 베이스 클래스
│   ├── Crawler.php            # 메인 크롤러 오케스트레이터
│   ├── BrandiCrawler.php      # 브랜디 크롤러
│   ├── BrichCrawler.php       # 브리치 크롤러
│   ├── MusinsaCrawler.php     # 무신사 크롤러
│   ├── SeoulStoreCrawler.php  # 서울스토어 크롤러
│   └── Store29cmCrawler.php   # 29CM 크롤러
├── Http/
│   ├── Controllers/
│   │   └── SearchController.php # 검색 컨트롤러
│   └── Livewire/
│       └── Search.php          # 검색 Livewire 컴포넌트
└── ...
```

## 🧪 테스트

```bash
# PHPUnit 테스트 실행
./vendor/bin/phpunit

# 또는
php artisan test
```

## 🔧 개발 명령어

### Laravel 관련
```bash
# 캐시 클리어
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# 마이그레이션
php artisan migrate

# 애플리케이션 키 생성
php artisan key:generate
```

### 프론트엔드
```bash
# 개발 빌드
npm run dev

# 프로덕션 빌드
npm run prod

# 핫 리로드
npm run hot
```

## 🚀 배포

```bash
# Laravel Envoy를 사용한 배포
envoy run deploy
```

## 📄 라이선스

이 프로젝트는 [MIT 라이선스](https://opensource.org/licenses/MIT) 하에 배포됩니다.
