<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project


This is an API fo googleplay apps base on [Kaggle](https://www.kaggle.com/lava18/google-play-store-apps?select=googleplaystore_user_reviews.csv)
Including about 8000 apps details and reviews.

### Built With

* [Laravel](https://laravel.com)


### Prerequisites

You should have installed php and composer

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/amir2539/google-play-back-end.git
   ```
2. Install Composer dependencies
   ```sh
   composer install



<!-- USAGE EXAMPLES -->
## Usage

There 2 api for getting all apps and single app reviews and details

1- Route "/" : 1- 10 most downloaded apps
                2- 10 best rated apps
                3- all apps with sort and pagination


2- Route "/{app}" : returns app details and reviews with pagination


<!-- CONTACT -->
## Contact

Amirmohammad torkaman - amirtorkamna5204@gmail.com

