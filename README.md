Pasos para realizar tarea 

Clonar proyecto 

CD superheroes-app

Composer install

cp .env.example .env
copiamos la data en .env de nuestra base de datos

php artisan key:generate

php artisan migrate 

Para SCV
composer require maatwebsite/excel --update-with-dependencies

Composer Update

Crear tabla en base de datos de super heroes.

Creo el Migration - 
    php artisan make:migration create_superheros_table

        Schema::create('superheros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->text('fullName')->nullable();
            $table->integer('strength');
            $table->integer('speed');
            $table->integer('durability');
            $table->integer('power');
            $table->integer('combat');
            $table->string('race')->nullable();
            $table->string('heigth')->nullable();
            $table->string('heigthCm')->nullable();
            $table->string('weightLb')->nullable();
            $table->string('weightKb')->nullable();
            $table->string('eyeColor')->nullable();
            $table->string('hairColor')->nullable();
            $table->string('publisher')->nullable();
        });

Crear en base de datos -
    php artisan migrate

Crear Modelo Superheroe.php para modelar la data.

        protected $fillable = [
        'name',
        'fullName',
        'strength',
        'speed',
        'durability',
        'power',
        'combat',
        'race',
        'heigth',
        'heigthCm',
        'weightLb',
        'weightKg',
        'eyeColor',
        'hairColor',
        'publisher'

    ];

Llenar base de datos con SCV a traves de un script -
    Use Maatwebsite\Excel\Facades\Excel para importar el SCV

    composer require maatwebsite/excel --update-with-dependencies

Se crea el controladro SuperheroeController.php para llevar a cabo el metodo de importado

    public function import(Request $request)
    {
        Excel::import(new SuperheroImport, $request->file);
        return back();
    }


Luego agrego el import para importar la data a la BD

     public function model(array $row)
    {
     
        return new Superhero([

         
            'name' => $row['name'],
            'fullName' => $row['fullname'],
            'strength' => $row['strength'],
            'speed' => $row['speed'],
            'durability' => $row['durability'],
            'power' => $row['power'],
            'combat' => $row['combat'],
            'race'=>$row['race'],
            'heigth'=> $row['height0'],
            'heigthCm'=> $row['height1'],
            'weigthLb'=> $row['weight0'],
            'weigthKg'=> $row['weight1'],
            'eyeColor'=>$row['eyecolor'],
            'hairColor'=>$row['haircolor'],
            'publisher'=>$row['publisher'],

                            
        ]);
    }


Y las rutas encargadas de todo esto en web.php

    Route::post('/importSuperheroes', [App\Http\Controllers\SuperheroController::class, 'import'])->name('importExcelSuperheroes');



Una vex importado el SCV 

Creo las APIS

Con un SuperheroeResources y toda la data del superheroe

    return [
                'id' => $this->id,
                'name' => $this->name,
                'fullName' => $this->fullName,
                'strength' => $this->strength,
                'speed' => $this->speed,
                'durability' => $this->durability,
                'power' => $this->power,
                'combat' => $this->combat,
                'race'=> $this->race,
                'heigth'=> $this->heigth,
                'heigthCm'=> $this->heigthCm,
                'weightLb'=> $this->weightLb,
                'weightKg'=> $this->weightKg,
                'eyeColor'=> $this->eyeColor,
                'hairColor'=> $this->hairColor,
                'publisher'=> $this->publisher,
            ];

Luego Rutas en api.php

            Route::apiResource('superhero', SuperheroController::class)->only(['getAllSuperheroes']);


Y el ruteo con los metodos en controladores para invocarlos

Se puede testear con POSTMAN una vez importado el CSV



1. listar todos los superheroes con paginado de 10

    Controlador

         public function getAllSuperheroes()
        {
            $superheroes = Superheroe::orderBy('name','desc')
                                                ->paginate(10);
            return SuperheroResources::collection($superheroes);
        }

    Ruta web.php
        Route::get('/superheroes', [App\Http\Controllers\SuperheroeController::class, 'getAllSuperheroes']);

    Postam Prueba
        www.localhost.com/superheroes

2. Traer los 3 primeros superheroes MAS RAPIDOS

    Controlador

         public function geThreeFastestSuperheroes()
            {
                $superheroes = Superheroe::orderBy('speed','desc')
                                                    ->take(3)
                                                    ->get();
                return SuperheroResources::collection($superheroes);
            }


    Ruta web.php
        Route::get('/superhero-fatest', [App\Http\Controllers\SuperheroeController::class, 'geThreeFastestSuperheroes']);

    Postam Prueba
        www.localhost.com/superhero-fatest


3. Traer superheroes filtrados por RAZA con un input a cargar en un form con request con paginado de 10

    Controlador

        public function getRaceSuperheroe(Request $request , $race)
            {
                $race = $request->input('race');     
                $superheroes = Superhero::Where('race', 'LIKE', "%$race%" )
                                                    ->paginate(10);
                return SuperheroResources::collection($superheroes);
            }

    Ruta web.php
        Route::get('/superhero-{race}', [App\Http\Controllers\SuperheroeController::class, 'getRaceSuperheroe']);

    
 
4. Traer el superheroe mas poderozo

    Controlador

        public function getPowerfulSuperheroe()
            {
                $superheroes = Superheroe::orderBy('power','desc')
                                        ->orderBy('strength', 'desc')
                                        ->orderBy('durability', 'desc')
                                        ->orderBy('combat', 'desc')
                                        ->orderBy('speed', 'desc')
                                        
                                                ->take(1)
                                                ->get();
                return SuperheroResources::collection($superheroes);
            }

    Ruta web.php
        Route::get('/superhero-power', [App\Http\Controllers\SuperheroeController::class, 'getPowerfulSuperheroe']);

    Postam Prueba
        www.localhost.com/superhero-power


    
 

