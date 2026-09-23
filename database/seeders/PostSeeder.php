<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $titles = ['A New Era of Exoplanet Atmosphere Studies', 'Mapping the Birthplaces of Stars', 'What We Have Learned From Gravitational Waves', 'Microbiomes and the Hidden Ecosystems Within Us',
            'How Plants Respond to Environmental Stress', 'The Science of Regenerating Damaged Tissues', 'Quantum Sensors: Measuring the Almost Unmeasurable',
            'Why Materials Behave Differently at the Nanoscale', 'Understanding Turbulence Through Computation', 'Catalysts and the Search for Greener Chemical Reactions',
            'How Batteries Store and Release Energy', 'The Chemistry Behind Atmospheric Aerosols', 'Large Language Models and Scientific Discovery',
            'Reproducible Data Pipelines for Research', 'Visualizing Complex Scientific Data', 'Reading the Climate Record in Ice Cores',
            'How Cities Affect Local Weather', 'Tracking Ocean Change With Autonomous Instruments', 'Sleep and the Architecture of Memory',
            'How the Brain Builds a Sense of Place', 'From Biomarkers to Earlier Disease Detection', 'Soft Robots Inspired by Living Organisms',
            'Designing More Efficient Solar Cells', 'Digital Twins for Complex Machines', 'Why Prime Numbers Matter', 'Modeling Networks With Graph Theory',
            'Mathematical Models and the Limits of Prediction', 'Why Negative Results Matter in Science', 'Open Science and the Future of Research',
            'How to Evaluate a Scientific Claim Online'];
        $bodies = ['Astronomers are increasingly able to study the chemical fingerprints of planets orbiting distant stars. This article explains how transit spectroscopy works, what atmospheric molecules can reveal, and why clouds and stellar activity remain major sources of uncertainty.',
            'Molecular clouds are the nurseries where stars form. New surveys combine infrared observations with radio measurements to map cold gas, dense cores, and the earliest stages of stellar evolution.',
            'Gravitational-wave astronomy has opened a new way of observing the universe. We explore how interferometers detect tiny changes in distance and what compact-object mergers teach us about black holes and neutron stars.',
            'The human body hosts complex microbial communities that interact with our immune system and metabolism. This overview discusses what microbiome research can establish and where researchers still need stronger evidence.',
            'Plants continuously adjust their physiology in response to drought, temperature, light, and pathogens. Scientists study these responses to understand adaptation and improve agricultural resilience.',
            'Regenerative biology investigates how organisms repair damaged cells and tissues. Stem cells, signaling pathways, and tissue scaffolds are central to current research.',
            'Quantum effects can be exploited to build extremely sensitive sensors. This post introduces atomic clocks, quantum magnetometers, and other technologies that turn fundamental physics into practical measurement tools.',
            'When structures become extremely small, surface effects and quantum confinement can dramatically change their behavior. Nanoscience uses these effects to design materials with unusual electrical, optical, and mechanical properties.',
             'Turbulent flows appear in oceans, aircraft engines, weather systems, and industrial processes. Numerical simulations help researchers investigate the complicated interactions across many length and time scales.',
            'Catalysts can reduce the energy required for chemical reactions and improve selectivity. Researchers are exploring catalysts that use abundant elements and produce less waste.',
            'Rechargeable batteries rely on reversible chemical reactions involving ions and electrons. Understanding electrode materials and interfaces is essential for improving lifetime, safety, and energy density.',
            'Tiny airborne particles influence air quality, cloud formation, and climate. Their chemistry changes as particles react with gases and sunlight in the atmosphere.',
            'Machine-learning systems are increasingly used to search literature, analyze data, generate hypotheses, and assist with code. This article examines useful applications as well as reproducibility and validation challenges.',
            'A scientific result is easier to verify when its data-processing steps are transparent and repeatable. Version control, automated tests, metadata, and containerized environments can make computational research more robust.',
            'Good visualization helps researchers discover patterns without hiding uncertainty. We discuss choices involving scales, aggregation, color, annotations, and interactive exploration.',
            'Ice cores preserve layers of information about past atmospheric conditions. By studying trapped gases, isotopes, dust, and chemistry, researchers reconstruct parts of Earth\'s climate history.',
            'Urban surfaces absorb and release heat differently from natural landscapes. Buildings, traffic, vegetation, and atmospheric conditions can combine to create measurable local temperature differences.',
            'Autonomous floats and underwater instruments collect measurements across vast regions of the ocean. These observations improve our understanding of temperature, salinity, circulation, and marine ecosystems.',
            'Sleep is associated with coordinated brain activity that changes across different stages. Researchers investigate how these patterns relate to learning, memory consolidation, and emotional processing.',
            'Navigation depends on networks of brain regions that represent location, direction, and context. Research on spatial memory has revealed specialized patterns of neural activity involved in navigating environments.',
            'Biomarkers can provide measurable signals associated with biological processes or disease. The challenge is determining which markers are reliable, specific, and useful in real clinical settings.',
            'Soft robotics uses flexible materials instead of exclusively rigid mechanical structures. Inspiration from muscles, tentacles, and other biological systems is leading to robots designed for delicate interactions.',
            'Solar-cell research combines materials science, electrical engineering, and manufacturing. Researchers seek better efficiency while considering stability, cost, scalability, and environmental impact.',
            'A digital twin is a computational representation connected to measurements from a physical system. Engineers use these models to monitor equipment, test scenarios, and investigate failures.',
            'Prime numbers are fundamental building blocks of arithmetic and appear throughout number theory. Their distribution continues to motivate research while also supporting practical applications such as cryptography.',
            'Graphs provide a mathematical language for representing relationships between objects. The same ideas can describe transportation systems, social networks, molecules, and computer infrastructure.',
            'A model is a structured simplification of reality. Even a mathematically elegant model can produce uncertain predictions when inputs are incomplete, parameters are estimated, or the underlying system is highly sensitive.',
            'A study that does not support its initial hypothesis can still provide valuable information. Transparent reporting of negative and inconclusive findings helps reduce duplication and gives researchers a more complete evidence base.',
            'Open data, open software, preprints, and transparent methods can make scientific work easier to inspect and reuse. Each approach also introduces practical questions about privacy, licensing, quality control, and incentives.',
            'Scientific claims on social media can be difficult to evaluate quickly. Checking the original study, population, methods, uncertainty, and independent evidence provides a better starting point than relying on headlines alone.'];
        $user_ids = [9, 16, 11, 9, 20, 10, 17, 13, 14, 20, 15, 6, 19, 18, 22, 22, 21, 8, 16, 12, 13, 11, 10, 15, 17, 14, 6, 19, 18, 21];

        for ($i=0;$i<30;$i++){
            Post::create([
                'title' => $titles[$i],
                'body' => $bodies[$i],
                'user_id' => $user_ids[$i]
            ]);
        }
    }
}
