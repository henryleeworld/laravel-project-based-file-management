# Laravel 8 基於專案的檔案管理

檔案管理在專案過程中，看似微小的一項日常作業，但卻扮演著舉足輕重的地位。因為在專案的每一個階段都會產出各式各樣的檔案內容。這些檔案，有些可能是過程、有些可能是階段、有些則可能是成果。而檔案的內容，則是作為專案溝通的主要來源、依據或準則，也為了確保專案溝通期間的正確與順暢，所取得的專案檔案就必需是最新及即時的，以作為該階段的參考或引入的基準。Laravel 8 基於專案的檔案管理主要是用 [QuickAdminPanel](https://quickadminpanel.com) 生成的，除了一些定制代碼，可依需求彈性改造的工具。

## 使用方式
- 把整個專案複製一份到你的電腦裡，這裡指的「內容」不是只有檔案，而是指所有整個專案的歷史紀錄、分支、標籤等內容都會複製一份下來。
```sh
$ git clone
```
- 將 __.env.example__ 檔案重新命名成 __.env__，如果應用程式金鑰沒有被設定的話，你的使用者 sessions 和其他加密的資料都是不安全的！
- 當你的專案中已經有 composer.lock，可以直接執行指令以讓 Composer 安裝 composer.lock 中指定的套件及版本。
```sh
$ composer install
```
- 產生 Laravel 要使用的一組 32 字元長度的隨機字串 APP_KEY 並存在 .env 內。
```sh
$ php artisan key:generate
```
- 執行 __Artisan__ 指令的 __migrate__ 來執行所有未完成的遷移。
```sh
$ php artisan migrate
```
- 執行安裝 Laravel Mix 引用的依賴項目，並執行所有 Mix 任務。
```sh
$ npm install && npm run dev
```
- 在瀏覽器中輸入已定義的路由 URL 來訪問，例如：http://127.0.0.1:8000。
- 你可以經由 `/register` 來進行註冊。
- 完成註冊後，可以經由 `/login` 來進行登入。
- 完成登入後，可以經由 `/projects` 來進行分配的專案檔案管理。

----

## 畫面截圖
![](https://i.imgur.com/SACtQSY.png)
> 建立新的專案

![](https://i.imgur.com/omHPvbS.png)
> 用檔案夾依照領域的內容分類

![](https://i.imgur.com/jAM41Gw.png)
> 空間容量的規劃視組織或專案所產製的文件多寡而定