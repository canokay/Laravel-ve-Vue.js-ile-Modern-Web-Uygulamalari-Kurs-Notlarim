# 2020 Özgür Yazılım Kış Kampı ( Laravel ve Vue.js ile Modern Web Uygulamaları Kursu )

![Kış Kampı Linux Logo][logo]

## Önemli Komutlar

-   TodoItem isminde model ona bağlı olarak migration ve controller dosyalarını oluşturmaya yarar.
    ```
      php artisan make:model TodoItem -mc
    ```
-   Komut satırı üzerinden php komutları çalıştırmamızı yarar.

    ```
      php artisan tinker
    ```

-   TodoItem ile oluşturulan database/migrations/ altında oluşturulan migrationı veritabanında oluşturmaya yarar.

    ```
      php artisan migrate: php artisan make:model TodoItem -mc
    ```

-   TodoItemController 'daki index metodunu çalıştır.

    ```
      Route::get('todos', 'TodoItemController@index');
    ```

-   Oluşturduğumuz modele herhangi bir veri girmek istersek tinker üzerinden ekleyebilir, düzenleyebilir veya silme işlemini kolaylıkla gerçekleştirebiliriz

    ```
      $todo1        =   new App\TodoItem;
      $todo->text   =   "Akşama vue tutoril'ını bitir";
      $todo->save();
    ```

-   Üyelik sistemi eklemek için kullanılır. ( --dev komutu ise sadece development ortamında bu bağımlılığa ihtiyacımız olduğunu söylüyoruz. )

    ```
      composer require laravel/ui --dev
    ```

Bağımlılık yüklendikten sonra laravel projesini aut ile ayağa kaldırmak istersek.
`php artisan ui bootstrap --auth`
Bu işlemin ardından ise node modules dosyalarını indirmek için ise
`npm install && npm run dev`

php artisan ui bootstrap --auth

## Bakılması Gereken Konular

-   bağımlılık sızdırma ( dependices injection )
-   laravel container yapısı
-   service container, service providers

## Önerilen Kaynaklar

-   Http yanıtlarının nasıl gidip geldiğini test etmek istersek: <b>[Httpbin](https://httpbin.org/)</b>
-   Http status codes: <b>[httpstatus](https://httpstatuses.com/)</b>
-   PHP için Bağımlılık Yöneticisi: [Composer](https://getcomposer.org/)
-   PHP standartları için öneriler: <b>[PSR](https://www.php-fig.org/psr/)</b>
-   [PHP magic methods](https://www.php.net/manual/tr/language.oop5.magic.php)

## Karşılaşılan Hatalar ve Çözümleri

### 1. Homestead kurulum aşaması

Kurulum aşamasında url üzerinden homestead.test yazdığımızda "no input file specified" hatası geliyor ise;
Öncelikle sanal makinenizi durdurun:
<b>vagrant halt</b>
Sonra yeniden başlatın ama provizyonlayarak:
<b>vagrant up --provision</b>

### 2. Birden fazla proje ile çalışmak için

homestead.yaml

```
  folders:
  - map: ~/Projects/scp
    to: /home/vagrant/Projects/scp
  - map: ~/Projects/katniss
    to: /home/vagrant/Projects/katniss

  sites:
  - map: scp.dev
    to: /home/vagrant/Projects/scp
  - map: katniss.dev
    to: /home/vagrant/Projects/katniss
```

hostfile

```
192.168.10.10 scp.dev
192.168.10.10 katniss.dev
```

Ardından homestead proje folder'ında "homestead up --provision" komutunu çalıştırmamız yeterli.

[logo]: https://kamp.linux.org.tr/2020/kis/wp-content/themes/oyk-wp-theme/assets/images/okk2020logo.png "Kış Kampı Linux"
