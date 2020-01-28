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
    Son olarak laraveli auth ile ayağa kaldırmak istersek.

    `php artisan ui bootstrap --auth`

-   Eğer migrate dosyasına herhangi bir field eklediysek `php artisan migrate:refresh` eklememiz gerekli.

-   todoıtem modeline bir kullanıcıya ait olduğunu belirtmemiz için

    ```
          public function user()
          {
              // todoItem bir user'a aittir.
              return $this->belongsTo(User::class);
          }
    ```

    bir kullanıcının birden fazla todoItem'ı olabilir diyoruz.

    ```
        public function todos()
        {
          return $this->hasMany(TodoItem::class);
        }
    ```

-   İlgili kullanıcıya ait todoları direk bize verir

    ```
      $todos = $request->user()->todos;
    ```

    lakin aşağıdaki gibi method ile çağırırsak query builderçalıştırmış oluyoruz. ardından methodları kullanıp datayı o haldede alabiliriz.

    ```
      $todos = $request->user()->todos()->latest()->get();
    ```

-   Laravel içerisine bootstrap dahil etmek istersek.

    ```
      php artisan ui bootstrap
    ```

-   Laravel içerisine vue dahil etmek istersek.

    ```
      php artisan ui vue
    ```

-   Vue.js'i kurduktan sonra

    1 - webpack.mix.js dosyasında

    ```
        mix.js("resources/js/app.js", "public/js")
        .sass("resources/sass/app.scss", "public/css")
        .version();
    ```

    2 - vuetest.blade.php'de asset olarak verdiğimiz app.js'i

    ```
      <script src="{{ mix('js/app.js') }}"></script>
    ```

    olarak değiştirmeliyiz.

    3 - son olarak vue daki yazdığımız değişiklikleri takip edebilmek için aşağıdaki kodu çalıştırıyoruz.

    ```
    `npm run watch`
    ```

## Bakılması Gereken Konular

-   Bağımlılık sızdırma ( dependices injection )
-   Laravel container yapısı
-   Service container, service providers
-   Middleware ( soğan örneği )
-   Authorization
-   API tarafında ki token bazlı yetkilendirmeyi jwt-auth kütüphanesini kullanarak aşacağız.
-   State Yönetimi için vuex
-   Vuex'teki istediğimiz herhangi bir state veya state'lerin kalıcı olmasını istiyorsak 'vuex-persistedstate' npm paketini kullanıyoruz.
-   Rotalama için ise vue router

## Önerilen Kaynaklar

-   Http yanıtlarının nasıl gidip geldiğini test etmek istersek: <b>[Httpbin](https://httpbin.org/)</b>
-   Http status codes: <b>[httpstatus](https://httpstatuses.com/)</b>
-   PHP için Bağımlılık Yöneticisi: [Composer](https://getcomposer.org/)
-   PHP standartları için öneriler: <b>[PSR](https://www.php-fig.org/psr/)</b>
-   [PHP magic methods](https://www.php.net/manual/tr/language.oop5.magic.php)
-   API için token bazlı yetkilendirme [jwt-auth](https://jwt-auth.readthedocs.io/en/develop/)

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

## Önemli Notlar

### Laravel 6 sürümü ile jwt-auth kütüphanesini kullanacak uygulanması gereken adımlar

composer.json dosyasına require alanına `"tymon/jwt-auth": "^1.0"` 1.0 ve üzerini çekmemiz gerekli.
Sonrasında ise https://jwt-auth.readthedocs.io/en/develop/laravel-installation/ adımları takip edebiliriz. Tek dikkat edilmesi gereken nokta ise `composer require tymon/jwt-auth`
komutu yerine `composer update` yapmalıyız. Çünkü relase sürümü laravel 6 sürümünü desteklememekte.

[logo]: https://kamp.linux.org.tr/2020/kis/wp-content/themes/oyk-wp-theme/assets/images/okk2020logo.png "Kış Kampı Linux"
