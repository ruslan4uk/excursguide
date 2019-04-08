<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'user_data';
    protected $fillable = ['user_id', 'about'];
    protected $guard = ['id', 'user_id', 'active', 'status', 'properties'];

    protected $casts = [
        'languages' => 'Array',
        'locations' => 'Array',
        'contacts'  => 'Object',
        'services'  => 'Json',
        'user_files' => 'Array',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function tour() {
        return $this->hasMany('App\Tour', 'user_id', 'user_id');
    }
    

    public function tourServices() {
        $tour_services = ToursService::all();

        $response = [];
        foreach($this->services as $id) {
            foreach($tour_services as $services) {
                if($services['id'] === $id) $response[] = $services['title'];
            }
        }
        return $response;
    }

    public function get_city_name($id) {
        $obj = Geodata\Cities::where('id', $id)
                    ->limit(25)
                    ->select('city.id','city.city','city.city_iso_code','city.region', 'country.country_name')
                    ->join('country', 'country.country_iso_code', '=', 'city.city_iso_code')
                    ->first();
        return $obj->city . ', ' . $obj->country_name;
    }


    public function contact_type($id) {
        switch($id) {
            case 1: 
                return '<i class="fas fa-phone"></i>';
                break;
            case 2: 
                return '<i class="fas fa-phone"></i>';
                break;
            case 3: 
                return '<i class="fab fa-skype"></i>';
                break;
            case 4:
                return '<i class="fab fa-telegram-plane"></i>';
                break;
            case 5:
                return '<i class="fab fa-viber"></i>';
                break;
            case 6:
                return '<i class="fab fa-whatsapp"></i>';
                break;
            default:
                break;
        }
    }


    public function currency($id) {
        switch($id) {
            case 643: 
                return ' руб';
                break;
            case 840: 
                return ' usd';
                break;
            case 978: 
                return ' eur';
                break;
            default:
                break;
        }
    }

    public function language($id) {
        switch($id) {
            case 'ru':
                return 'Русский';
                break;
            case 'en':
                return 'Английский';
                break;
            default:
                break;
        }
    }



    /**
     * TODO: Delete
     *
     * @return void
     */
    public function categoryName() {

        $arr = array(
            ['id' => 1, 'title' => 'Групповые экскурсии/туры'],
            ['id' => 2, 'title' => 'Обзорные экскурсии/туры'],
            ['id' => 3, 'title' => 'Авторские экскурсии/туры'],
            ['id' => 4, 'title:' => 'Гастрономические экскурсии/туры'],
            ['id' => 5, 'title:' => 'Экскурсии на автомобиле'],
            ['id' => 6, 'title:' => 'Пешеходные экскурсии'],
            ['id' => 7, 'title:' => 'Велотур/ велопоход'],
            ['id' => 8, 'title:' => 'Шопинг /шопинг тур'],
            ['id' => 9, 'title:' => 'Фотосессия'],
            ['id' => 10, 'title' => 'Экскурсии по крышам'],
            ['id' => 11, 'title' => 'Детские экскурсии/туры'],
            ['id' => 12, 'title' => 'Паломничество'],
            ['id' => 13, 'title' => 'Трансфер'],
            ['id' => 14, 'title' => 'Круиз'],
            ['id' => 15, 'title' => 'Квест'],
            ['id' => 16, 'title' => 'Оздоровительный тур'],
            ['id' => 17, 'title' => 'Восхождение в горы'],
            ['id' => 18, 'title' => 'Дайвинг'],
            ['id' => 19, 'title' => 'Джиппинг'],
            ['id' => 20, 'title' => 'Йога тур'],
            ['id' => 21, 'title' => 'Свадебная церемония'],
            ['id' => 22, 'title' => 'Сноркелинг / снорклинг'],
            ['id' => 23, 'title' => 'Экстрим'],
            ['id' => 24, 'title' => 'Ночные экскурсии'],
            ['id' => 25, 'title' => 'Полеты'],
            ['id' => 26, 'title' => 'Музеи'],
            ['id' => 27, 'title' => 'Достопримечательности'],
            ['id' => 28, 'title' => 'Рыбалка'],
            ['id' => 29, 'title' => 'Природа'],
            ['id' => 30, 'title' => 'Морские/речные туры/экскурсии'],
        );

        $serviceId = $this->pluck('services')->toArray();
        
    
        //return $this->pluck('services')->toArray();
    }
}
