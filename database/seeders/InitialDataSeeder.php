<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // Desactivar verificaciones de clave foránea temporalmente
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 1. Tabla mantenimiento_info
        DB::table('mantenimiento_info')->truncate();
        DB::table('mantenimiento_info')->insert([
            [
                'id' => 1,
                'nombre' => 'Mantenimiento',
                'texto' => 'Conjunto de operaciones y cuidados necesarios para que tus instalaciones continúen funcionando correctamente.',
                'activo' => true
            ],
            [
                'id' => 2,
                'nombre' => 'Mantenimiento Preventivo',
                'texto' => 'Ayuda a prolongar la vida útil de tus activos y aumenta la productividad, a través de una revisión.',
                'activo' => true
            ],
            [
                'id' => 3,
                'nombre' => 'Mantenimiento Correctivo',
                'texto' => 'Corrige problemas o daños en las instalaciones o equipos.',
                'activo' => true
            ]
        ]);

        // 2. Tabla categoria_servicio
        DB::table('categoria_servicio')->truncate();
        DB::table('categoria_servicio')->insert([
            [
                'id' => 1,
                'nombre' => 'Aire Acondicionado',
                'imagen' => 'https://www.energyandwater.cl/gallery_gen/3cf1905198e9763be7cf8a3276a8375b_559x1125_79x0_771x1125_crop.jpg',
                'texto' => 'Instalamos, reparamos y revisamos todo tipo de sistemas de aire acondicionado, tanto domésticos como industriales. Nos encargamos de la limpieza, el cambio de filtros, la recarga de gas y la detección y solución de averías.',
                'activo' => true
            ],
            [
                'id' => 2,
                'nombre' => 'Grupo Electrógeno',
                'imagen' => 'https://www.energyandwater.cl/gallery_gen/1dff1ecb88d5aa605aa877c96cd9df8b_640x1116_fit.jpg',
                'texto' => 'Instalamos, reparamos y revisamos todo tipo de grupos electrógenos, tanto monofásicos como trifásicos. Nos encargamos del suministro de combustible, el cambio de aceite, el control de baterías y la verificación del funcionamiento correcto.',
                'activo' => true
            ],
            [
                'id' => 3,
                'nombre' => 'Sala de Calderas',
                'imagen' => 'https://www.energyandwater.cl/gallery_gen/9d0c9a5af9f0a48e29f3d3b61818457e_640x1176_fit.jpg',
                'texto' => 'Instalamos, reparamos y revisamos todo tipo de calderas, tanto de gas como eléctricas. Nos encargamos del mantenimiento preventivo, la sustitución de piezas, la purga de radiadores y la regulación de la presión y la temperatura.',
                'activo' => true
            ],
            [
                'id' => 4,
                'nombre' => 'Sala de Bombas',
                'imagen' => 'https://www.energyandwater.cl/gallery_gen/6f174bfc2c2d263b250ab7bee3d6255f_640x1116_fit.jpg',
                'texto' => 'Instalamos, reparamos y revisamos todo tipo de bombas hidráulicas, tanto centrífugas como periféricas. Nos encargamos del ajuste de válvulas, el cambio de sellos mecánicos, el equilibrado de rotores y la limpieza de impulsores.',
                'activo' => true
            ]
        ]);

        // 3. Tabla info_contacto
        DB::table('info_contacto')->truncate();
        DB::table('info_contacto')->insert([
            [
                'id' => 1,
                'nombre' => 'email',
                'texto' => 'contacto@energyandwater.cl',
                'texto_adicional' => 'mailto:contacto@energyandwater.cl',
                'activo' => true
            ],
            [
                'id' => 2,
                'nombre' => 'direccion',
                'texto' => 'Manquehue Sur 520, oficina 205, Las Condes',
                'texto_adicional' => 'https://googlemaps',
                'activo' => true
            ],
            [
                'id' => 3,
                'nombre' => 'telefono',
                'texto' => '+56 2 3256 9798',
                'texto_adicional' => 'phone:+56232569798',
                'activo' => true
            ],
            [
                'id' => 4,
                'nombre' => 'whatsapp',
                'texto' => '+56 9 3083 5203',
                'texto_adicional' => 'https://api.whatsapp.com/send/?phone=%2B56930835203&text&type=phone_number&app_absent=0',
                'activo' => true
            ]
        ]);

        // 4. Tabla imagen (primera parte)
        DB::table('imagen')->truncate();
        DB::table('imagen')->insert([
            [
                'id' => 1,
                'nombre' => 'Reparación de Matriz en CESFAM Padre Pierre Dubois, Pedro Aguirre Cerda.',
                'imagen' => 'https://www.energyandwater.cl/gallery_gen/c4efc61dd95fc5f46d5bcca4a4602205_fit.jpg',
                'activo' => true
            ],
            [
                'id' => 2,
                'nombre' => 'Universidad De Los Andes',
                'imagen' => 'https://www.energyandwater.cl/gallery_gen/5d11f12cdc2ed7cc9f331218cb5b9ca0_640x608_fit.jpg',
                'activo' => true
            ],
            [
                'id' => 3,
                'nombre' => 'Viña Cousiño Macul',
                'imagen' => 'https://www.energyandwater.cl/gallery_gen/bff51c94eebee5ca25ea6f9aeccc8491_640x608_fit.jpg',
                'activo' => true
            ]
        ]);

        // 5. Tabla historia
        DB::table('historia')->truncate();
        DB::table('historia')->insert([
            [
                'id' => 1,
                'tipo' => 'titulo',
                'texto' => 'Creando ambientes gratos y confortables a través del mantenimiento.',
                'activo' => true
            ],
            [
                'id' => 2,
                'tipo' => 'subtitulo',
                'texto' => 'Resumen',
                'activo' => true
            ],
            [
                'id' => 3,
                'tipo' => 'parrafo',
                'texto' => 'Bienvenido a Energy and Water SpA, empresa dedicada a la instalación y reparación de sistemas de ventilación, calefacción, electricidad y construcción. Contamos con un equipo de profesionales altamente cualificados y con amplia experiencia en el sector. Ofrecemos soluciones a medida para cada cliente, garantizando la calidad y la seguridad de nuestros servicios. Contacta con nosotros y solicita tu presupuesto sin compromiso.',
                'activo' => true
            ],
            [
                'id' => 4,
                'tipo' => 'imagen',
                'texto' => '',
                'activo' => true
            ],
            [
                'id' => 5,
                'tipo' => 'subtitulo',
                'texto' => 'En qué punto nos encontramos',
                'activo' => true
            ],
            [
                'id' => 6,
                'tipo' => 'parrafo',
                'texto' => 'Somos una empresa fundada en 2018 con el objetivo de brindar servicios integrales de mantenimiento para hogares, oficinas, comercios e industrias. Nuestra misión es satisfacer las necesidades de nuestros clientes con eficiencia, rapidez y profesionalidad. Nuestra visión es ser la empresa referente en el mercado por nuestra excelencia y compromiso. Nuestros valores son la honestidad, la responsabilidad, el respeto y la innovación.',
                'activo' => true
            ],
            [
                'id' => 7,
                'tipo' => 'imagen',
                'texto' => '',
                'activo' => true
            ]
        ]);

        // 6. Tabla historia_imagen
        DB::table('historia_imagen')->truncate();
        DB::table('historia_imagen')->insert([
            ['id' => 1, 'historia_id' => 4, 'imagen_id' => 1],
            ['id' => 2, 'historia_id' => 7, 'imagen_id' => 2],
            ['id' => 3, 'historia_id' => 7, 'imagen_id' => 3]
        ]);

        // 7. Tabla equipo
        DB::table('equipo')->truncate();
        DB::table('equipo')->insert([
            [
                'id' => 1,
                'tipo' => 'titulo',
                'texto' => 'Compartimos una visión clara del objetivo, fomentamos un clima de confianza, colaboración y apoyo mutuo entre los integrantes del equipo.',
                'activo' => true
            ],
            [
                'id' => 2,
                'tipo' => 'subtitulo',
                'texto' => 'Liderazgo',
                'activo' => true
            ],
            [
                'id' => 3,
                'tipo' => 'parrafo',
                'texto' => 'Mizraim Abello es el fundador de Energy and Water SpA, es un líder colaborativo que se desempeña en el ámbito laboral, específicamente en el sector de la climatización y electricidad. Practica un liderazgo democrático; es decir, que involucra al equipo de trabajo en la toma de decisiones y valora sus opiniones y sugerencias. Sus principales habilidades como líder son la resolución de problemas, la comunicación efectiva, el pensamiento crítico, la capacidad de coordinación y gestión. Algunos de los logros más destacados son haber participado en la acreditación de los centros de salud de la municipalidad de San Joaquín, reparación del equipo de climatización para el museo de la Universidad de los Andes y haber realizado reparaciones y cambios de grupos electrógenos que son críticos para el funcionamiento de los edificios. Uno de los desafíos que enfrentó como líder fue adaptarse a las nuevas normativas sanitarias por la pandemia y garantizar la seguridad del equipo y los clientes. Lo logró implementando protocolos de prevención y capacitando al personal. Su objetivo como líder es darle continuidad operacional a los clientes y mejorar constantemente los procesos de mantenimiento y calidad.',
                'activo' => true
            ],
            [
                'id' => 4,
                'tipo' => 'imagen',
                'texto' => '',
                'activo' => true
            ],
            [
                'id' => 5,
                'tipo' => 'subtitulo',
                'texto' => 'Este es nuestro equipo',
                'activo' => true
            ],
            [
                'id' => 6,
                'tipo' => 'parrafo',
                'texto' => 'En Energy And Water SpA nos dedicamos a crear ambientes gratos y confortables a través del mantenimiento para calderas, aire acondicionado, salas de bombas, grupos electrógenos y electricidad, entre otros.',
                'activo' => true
            ],
            [
                'id' => 7,
                'tipo' => 'imagen',
                'texto' => '',
                'activo' => true
            ]
        ]);

        // 8. Tabla imagen (segunda parte)
        DB::table('imagen')->insert([
            [
                'id' => 4,
                'nombre' => 'Mantenimiento para edificios',
                'imagen' => 'https://www.energyandwater.cl/gallery_gen/0b901c86ff523e2ff3dcc5c6fff6e437_fit.jpg',
                'activo' => true
            ],
            [
                'id' => 5,
                'nombre' => 'El servicio nos mueve',
                'imagen' => 'https://www.energyandwater.cl/gallery_gen/9fca2b80ef03973c6c70faaa8fa3a5a5_fit.jpg',
                'activo' => true
            ]
        ]);

        // 9. Tabla equipo_imagen
        DB::table('equipo_imagen')->truncate();
        DB::table('equipo_imagen')->insert([
            ['id' => 1, 'equipo_id' => 4, 'imagen_id' => 4],
            ['id' => 2, 'equipo_id' => 7, 'imagen_id' => 5]
        ]);

        // 10. Tabla pregunta_frecuente
        DB::table('pregunta_frecuente')->truncate();
        DB::table('pregunta_frecuente')->insert([
            [
                'id' => 1,
                'pregunta' => '¿Cómo solicito una cotización?',
                'respuesta' => 'Puedes contactarnos al correo contacto@energyandwater.cl o al +56232569798.',
                'activo' => true
            ],
            [
                'id' => 2,
                'pregunta' => '¿Necesitas visita técnica?',
                'respuesta' => 'Puedes solicitar visita técnica para evaluación mediante correo electrónico Contacto@energyandwater.cl o al +56232569798.',
                'activo' => true
            ],
            [
                'id' => 3,
                'pregunta' => '¿Qué tipo de aire acondicionado pueden revisar?',
                'respuesta' => 'Revisamos, reparamos e instalamos equipos domiciliarios e industriales.',
                'activo' => true
            ]
        ]);

        // Reactivar verificaciones de clave foránea
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}