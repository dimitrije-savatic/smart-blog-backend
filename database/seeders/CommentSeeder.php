<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $comments = [
            'A New Era of Exoplanet Atmosphere Studies' => [
                [
                    'author' => 'Dimitrije Savatić',
                    'body' => 'The recent progress in spectroscopy is making exoplanet atmospheres much easier to study. I am particularly interested in how atmospheric composition can help us distinguish between different formation scenarios.',
                    'replies' => [
                        [
                            'author' => 'Dr Elena Petrović',
                            'body' => 'Agreed. The combination of transmission and emission spectroscopy gives us complementary information, especially for planets with thick atmospheres.'
                        ],
                        [
                            'author' => 'Dr James Anderson',
                            'body' => 'Another interesting aspect is how clouds can complicate the interpretation. Some atmospheric signatures may be hidden rather than genuinely absent.'
                        ],
                    ],
                ],
                [
                    'author' => 'Sophie Laurent',
                    'body' => 'I wonder how much future observations will change our understanding of smaller rocky exoplanets. Gas giants are much easier to characterize, but terrestrial planets are arguably more interesting.',
                    'replies' => [
                        [
                            'author' => 'Dr Maria Rossi',
                            'body' => 'That is probably where the biggest observational challenges will appear. The signal from a small rocky planet is extremely weak compared with its host star.'
                        ],
                    ],
                ],
            ],

            'Mapping the Birthplaces of Stars' => [
                [
                    'author' => 'Mila Petrović',
                    'body' => 'Molecular clouds are fascinating because they show how complex structures can emerge from relatively diffuse material. Mapping them also gives us clues about where future stars may form.',
                    'replies' => [
                        [
                            'author' => 'Kenji Tanaka',
                            'body' => 'The role of magnetic fields seems particularly important. They can influence both the collapse of clouds and the formation of filamentary structures.'
                        ],
                    ],
                ],
                [
                    'author' => 'Dr Tijana Prodanović',
                    'body' => 'It is interesting that star formation is not simply a matter of gravity causing a cloud to collapse. Turbulence, magnetic fields and feedback all compete with gravitational collapse.',
                    'replies' => [
                        [
                            'author' => 'Oliver Bennett',
                            'body' => 'Exactly. Stellar feedback can even regulate the next generation of stars by dispersing nearby molecular material.'
                        ],
                    ],
                ],
            ],

            'What We Have Learned From Gravitational Waves' => [
                [
                    'author' => 'Mr Nikola Jovanović',
                    'body' => 'Gravitational-wave observations have opened an entirely new way of studying compact objects. The ability to observe black-hole mergers directly is remarkable.',
                    'replies' => [
                        [
                            'author' => 'Dr James Anderson',
                            'body' => 'And the population data are becoming increasingly useful. We can now ask statistical questions about how these systems form rather than studying isolated events.'
                        ],
                    ],
                ],
                [
                    'author' => 'Aisha Rahman',
                    'body' => 'I think the multimessenger aspect is just as important as the gravitational-wave detections themselves. Combining different observations can provide a much richer picture.',
                    'replies' => [
                        [
                            'author' => 'Emily Carter',
                            'body' => 'Yes, especially when electromagnetic observations identify the host galaxy or provide information about the environment around the merger.'
                        ],
                    ],
                ],
            ],

            'Microbiomes and the Hidden Ecosystems Within Us' => [
                [
                    'author' => 'Dr Maria Rossi',
                    'body' => 'The microbiome illustrates how difficult it is to define an individual organism in isolation. Our physiology is influenced by a huge community of microorganisms.',
                    'replies' => [
                        [
                            'author' => 'Ana Marković',
                            'body' => 'The challenge is separating correlation from causation. A microbiome associated with a disease does not necessarily mean that it caused the disease.'
                        ],
                        [
                            'author' => 'Dimitrije Savatić',
                            'body' => 'That distinction seems especially important when interpreting studies based on dietary changes or observational datasets.'
                        ],
                    ],
                ],
                [
                    'author' => 'Lucas Miller',
                    'body' => 'I am curious about how stable the microbiome really is over long periods. Diet, medication and environment can all introduce substantial changes.',
                    'replies' => [
                        [
                            'author' => 'Sophie Laurent',
                            'body' => 'There appears to be both a relatively stable core and a more variable component that responds to environmental factors.'
                        ],
                    ],
                ],
            ],

            'How Plants Respond to Environmental Stress' => [
                [
                    'author' => 'Dr Elena Petrović',
                    'body' => 'Plants have remarkably sophisticated mechanisms for responding to drought and temperature stress. Hormonal signaling seems to coordinate responses across different tissues.',
                    'replies' => [
                        [
                            'author' => 'Dr Tijana Prodanović',
                            'body' => 'Abscisic acid is particularly interesting in drought responses because it influences stomatal closure and water conservation.'
                        ],
                    ],
                ],
                [
                    'author' => 'Kenji Tanaka',
                    'body' => 'It would be interesting to compare these mechanisms across crops. Some species appear much more tolerant of prolonged environmental stress than others.',
                    'replies' => [
                        [
                            'author' => 'Mila Petrović',
                            'body' => 'That comparison could be very useful for agricultural breeding programs, especially as environmental conditions become less predictable.'
                        ],
                    ],
                ],
            ],

            'The Science of Regenerating Damaged Tissues' => [
                [
                    'author' => 'Dr Sofia Alvarez',
                    'body' => 'Regenerative medicine is fascinating because different tissues have very different capacities for repair. Understanding why some cells regenerate while others form scar tissue is a major question.',
                    'replies' => [
                        [
                            'author' => 'Dr Maria Rossi',
                            'body' => 'The extracellular matrix seems to be an important part of that process. It provides both structural support and biochemical signals.'
                        ],
                    ],
                ],
                [
                    'author' => 'Aisha Rahman',
                    'body' => 'Stem-cell therapies receive a lot of attention, but controlling the surrounding tissue environment seems equally important for successful regeneration.',
                    'replies' => [
                        [
                            'author' => 'Dr James Anderson',
                            'body' => 'Exactly. Introducing cells without recreating the appropriate signaling environment may not be sufficient for functional regeneration.'
                        ],
                    ],
                ],
            ],

            'Quantum Sensors: Measuring the Almost Unmeasurable' => [
                [
                    'author' => 'Dr James Anderson',
                    'body' => 'Quantum sensors demonstrate how quantum effects can be turned into practical measurement technologies. Their sensitivity could be useful in fields ranging from geology to medicine.',
                    'replies' => [
                        [
                            'author' => 'Daniel Kim',
                            'body' => 'The main challenge seems to be maintaining coherence in real-world environments. Laboratory demonstrations can be much easier than practical deployment.'
                        ],
                    ],
                ],
                [
                    'author' => 'Sophie Laurent',
                    'body' => 'I find the possibility of using quantum sensors for detecting tiny magnetic-field variations particularly interesting.',
                    'replies' => [
                        [
                            'author' => 'Kenji Tanaka',
                            'body' => 'That could have applications in both fundamental physics and medical imaging, depending on how the technology develops.'
                        ],
                    ],
                ],
            ],

            'Why Materials Behave Differently at the Nanoscale' => [
                [
                    'author' => 'Daniel Kim',
                    'body' => 'The change in material properties at small scales is a good reminder that bulk properties cannot always be extrapolated down to individual nanoparticles.',
                    'replies' => [
                        [
                            'author' => 'Dr Elena Petrović',
                            'body' => 'Surface effects become disproportionately important as the surface-to-volume ratio increases.'
                        ],
                    ],
                ],
                [
                    'author' => 'Oliver Bennett',
                    'body' => 'Quantum confinement is another excellent example. Electronic properties can change significantly when structures become sufficiently small.',
                    'replies' => [
                        [
                            'author' => 'Dimitrije Savatić',
                            'body' => 'This is one reason nanomaterials are so interesting for electronics and optical applications.'
                        ],
                    ],
                ],
            ],

            'Understanding Turbulence Through Computation' => [
                [
                    'author' => 'Lucas Miller',
                    'body' => 'Turbulence seems like one of those problems where computational methods are essential because analytical solutions are extremely limited.',
                    'replies' => [
                        [
                            'author' => 'Mr Nikola Jovanović',
                            'body' => 'Large-eddy simulations provide an interesting compromise between resolving every scale and relying entirely on simplified turbulence models.'
                        ],
                    ],
                ],
                [
                    'author' => 'Dr Tijana Prodanović',
                    'body' => 'Computational power has clearly changed what researchers can investigate, but the quality of the underlying models remains just as important.',
                    'replies' => [
                        [
                            'author' => 'Daniel Kim',
                            'body' => 'Exactly. More computing power does not automatically compensate for incorrect assumptions in the physical model.'
                        ],
                    ],
                ],
            ],

            'Catalysts and the Search for Greener Chemical Reactions' => [
                [
                    'author' => 'Dr Maria Rossi',
                    'body' => 'Catalysts are one of the most effective ways to reduce the energy requirements of chemical processes. Selectivity is just as important as catalytic activity, though.',
                    'replies' => [
                        [
                            'author' => 'Ana Marković',
                            'body' => 'A highly active catalyst that produces many unwanted byproducts may not actually provide much environmental benefit.'
                        ],
                    ],
                ],
                [
                    'author' => 'Emily Carter',
                    'body' => 'I am particularly interested in heterogeneous catalysts because they can often be separated from reaction mixtures and reused.',
                    'replies' => [
                        [
                            'author' => 'Dr Sofia Alvarez',
                            'body' => 'Recyclability is an important factor when evaluating the overall sustainability of a catalytic process.'
                        ],
                    ],
                ],
            ],

            'How Batteries Store and Release Energy' => [
                [
                    'author' => 'Dimitrije Savatić',
                    'body' => 'Rechargeable batteries rely on reversible chemical reactions involving ions and electrons. Understanding electrode materials and interfaces is essential for improving lifetime, safety, and energy density.',
                    'replies' => [
                        [
                            'author' => 'Dr Elena Petrović',
                            'body' => 'The interface between the electrode and electrolyte is especially interesting because many degradation processes begin there.'
                        ],
                        [
                            'author' => 'Kenji Tanaka',
                            'body' => 'It is also important to consider how charging speed changes the internal chemistry rather than treating charging as a purely electrical process.'
                        ],
                    ],
                ],
                [
                    'author' => 'Sophie Laurent',
                    'body' => 'Different battery chemistries involve significant trade-offs between energy density, power output, lifetime and safety.',
                    'replies' => [
                        [
                            'author' => 'Lucas Miller',
                            'body' => 'That is why there probably will not be one battery chemistry that dominates every application.'
                        ],
                    ],
                ],
            ],

            'The Chemistry Behind Atmospheric Aerosols' => [
                [
                    'author' => 'Dr Tijana Prodanović',
                    'body' => 'Atmospheric aerosols are chemically complex because particles can undergo reactions after they are released into the atmosphere.',
                    'replies' => [
                        [
                            'author' => 'Aisha Rahman',
                            'body' => 'Their interaction with sunlight and clouds also makes their climate effects particularly difficult to model.'
                        ],
                    ],
                ],
                [
                    'author' => 'Emily Carter',
                    'body' => 'Aerosols are a good example of why atmospheric chemistry and climate science cannot really be separated.',
                    'replies' => [
                        [
                            'author' => 'Oliver Bennett',
                            'body' => 'Yes, especially when considering how particle size and composition affect their optical properties.'
                        ],
                    ],
                ],
            ],

            'Large Language Models and Scientific Discovery' => [
                [
                    'author' => 'Daniel Kim',
                    'body' => 'Language models could be useful for navigating large scientific literature collections, but generating a plausible explanation is not the same as establishing that the explanation is correct.',
                    'replies' => [
                        [
                            'author' => 'Dr James Anderson',
                            'body' => 'Verification has to remain part of the workflow. Scientific usefulness depends on connecting generated ideas to reproducible evidence.'
                        ],
                        [
                            'author' => 'Mila Petrović',
                            'body' => 'I think the strongest applications may be those where the model assists researchers rather than replacing experimental validation.'
                        ],
                    ],
                ],
                [
                    'author' => 'Dr Sofia Alvarez',
                    'body' => 'Another interesting possibility is using models to generate hypotheses that researchers would not have considered otherwise.',
                    'replies' => [
                        [
                            'author' => 'Dimitrije Savatić',
                            'body' => 'That could be valuable if researchers can efficiently test the resulting hypotheses instead of treating generated suggestions as conclusions.'
                        ],
                    ],
                ],
            ],

            'Reproducible Data Pipelines for Research' => [
                [
                    'author' => 'Mr Nikola Jovanović',
                    'body' => 'Reproducibility is often discussed as a statistical issue, but software and data infrastructure are equally important.',
                    'replies' => [
                        [
                            'author' => 'Daniel Kim',
                            'body' => 'Versioning raw data, preprocessing scripts and dependencies can make a huge difference when someone tries to reproduce the analysis months later.'
                        ],
                    ],
                ],
                [
                    'author' => 'Ana Marković',
                    'body' => 'Automated pipelines also reduce the risk of manually repeating slightly different preprocessing steps for different experiments.',
                    'replies' => [
                        [
                            'author' => 'Sophie Laurent',
                            'body' => 'And containers can help ensure that the computational environment itself is documented and reproducible.'
                        ],
                    ],
                ],
            ],

            'Visualizing Complex Scientific Data' => [
                [
                    'author' => 'Mila Petrović',
                    'body' => 'Good visualization is not just about making a figure attractive. The design should help reveal patterns without introducing misleading visual effects.',
                    'replies' => [
                        [
                            'author' => 'Dr Maria Rossi',
                            'body' => 'Choosing appropriate scales and avoiding unnecessary transformations is particularly important when comparing scientific measurements.'
                        ],
                    ],
                ],
                [
                    'author' => 'Oliver Bennett',
                    'body' => 'Interactive visualizations are useful for exploring high-dimensional datasets, although static figures are still much easier to preserve and cite in publications.',
                    'replies' => [
                        [
                            'author' => 'Emily Carter',
                            'body' => 'A combination of both can work well: interactive exploration during analysis and carefully designed static figures for communication.'
                        ],
                    ],
                ],
            ],

            'Reading the Climate Record in Ice Cores' => [
                [
                    'author' => 'Dr Sofia Alvarez',
                    'body' => 'Ice cores provide an extraordinary record because trapped gases and chemical markers preserve information about past atmospheric conditions.',
                    'replies' => [
                        [
                            'author' => 'Dr Elena Petrović',
                            'body' => 'The challenge is establishing precise age relationships between different layers and records.'
                        ],
                    ],
                ],
                [
                    'author' => 'Kenji Tanaka',
                    'body' => 'I find the comparison between ice-core records and other paleoclimate proxies particularly useful because each method has different limitations.',
                    'replies' => [
                        [
                            'author' => 'Lucas Miller',
                            'body' => 'Using independent proxies helps researchers distinguish regional signals from broader climate patterns.'
                        ],
                    ],
                ],
            ],

            'How Cities Affect Local Weather' => [
                [
                    'author' => 'Aisha Rahman',
                    'body' => 'Urban areas can create their own microclimates through changes in surface materials, vegetation and heat storage.',
                    'replies' => [
                        [
                            'author' => 'Mr Nikola Jovanović',
                            'body' => 'The urban heat island effect is particularly noticeable during calm conditions when heat accumulated during the day is released slowly.'
                        ],
                    ],
                ],
                [
                    'author' => 'Dr Tijana Prodanović',
                    'body' => 'Urban planning therefore has an indirect relationship with local weather conditions. Trees, reflective surfaces and building density can all matter.',
                    'replies' => [
                        [
                            'author' => 'Ana Marković',
                            'body' => 'It would be interesting to compare how effective different city designs are under the same regional climate.'
                        ],
                    ],
                ],
            ],

            'Tracking Ocean Change With Autonomous Instruments' => [
                [
                    'author' => 'Sophie Laurent',
                    'body' => 'Autonomous instruments dramatically increase the amount of ocean data that can be collected compared with traditional ship-based measurements.',
                    'replies' => [
                        [
                            'author' => 'Dr James Anderson',
                            'body' => 'Long-duration autonomous measurements are particularly useful for observing seasonal and regional changes that short expeditions can miss.'
                        ],
                    ],
                ],
                [
                    'author' => 'Emily Carter',
                    'body' => 'Data quality and calibration must be major concerns when instruments are operating remotely for long periods.',
                    'replies' => [
                        [
                            'author' => 'Dr Maria Rossi',
                            'body' => 'Absolutely. Autonomous observations are only useful if sensor drift and environmental effects are properly accounted for.'
                        ],
                    ],
                ],
            ],

            'Sleep and the Architecture of Memory' => [
                [
                    'author' => 'Dr Elena Petrović',
                    'body' => 'The relationship between sleep and memory is interesting because different stages of sleep appear to contribute to different aspects of memory processing.',
                    'replies' => [
                        [
                            'author' => 'Dr Sofia Alvarez',
                            'body' => 'The interaction between memory consolidation and neural activity during sleep is particularly fascinating.'
                        ],
                    ],
                ],
                [
                    'author' => 'Daniel Kim',
                    'body' => 'It would be interesting to know how much individual variation exists. Sleep duration alone probably does not capture the full picture.',
                    'replies' => [
                        [
                            'author' => 'Mila Petrović',
                            'body' => 'Sleep quality and continuity seem to matter as well, so two people with the same total sleep duration may not have equivalent sleep patterns.'
                        ],
                    ],
                ],
            ],

            'How the Brain Builds a Sense of Place' => [
                [
                    'author' => 'Dr Sofia Alvarez',
                    'body' => 'Spatial memory is a great example of how perception, memory and decision-making interact rather than operating as completely separate systems.',
                    'replies' => [
                        [
                            'author' => 'Lucas Miller',
                            'body' => 'The role of hippocampal activity in representing spatial relationships is especially interesting.'
                        ],
                    ],
                ],
                [
                    'author' => 'Ana Marković',
                    'body' => 'Navigation is also influenced by visual landmarks and previous experience, which makes the process more complex than simply calculating coordinates.',
                    'replies' => [
                        [
                            'author' => 'Kenji Tanaka',
                            'body' => 'Yes, humans seem to combine multiple sources of information when constructing an internal representation of an environment.'
                        ],
                    ],
                ],
            ],

            'From Biomarkers to Earlier Disease Detection' => [
                [
                    'author' => 'Dr Maria Rossi',
                    'body' => 'Earlier detection could significantly improve treatment options, but biomarkers need to be validated carefully before they are used clinically.',
                    'replies' => [
                        [
                            'author' => 'Dr Tijana Prodanović',
                            'body' => 'Especially because a statistically significant biomarker is not necessarily clinically useful on its own.'
                        ],
                    ],
                ],
                [
                    'author' => 'Aisha Rahman',
                    'body' => 'Combining multiple weak signals may sometimes provide more useful information than relying on a single biomarker.',
                    'replies' => [
                        [
                            'author' => 'Dr James Anderson',
                            'body' => 'That is where machine-learning approaches may help, provided the models are properly validated on independent populations.'
                        ],
                    ],
                ],
            ],

            'Soft Robots Inspired by Living Organisms' => [
                [
                    'author' => 'Oliver Bennett',
                    'body' => 'Soft robotics is interesting because biological organisms achieve complex movement without relying on rigid mechanical structures everywhere.',
                    'replies' => [
                        [
                            'author' => 'Dimitrije Savatić',
                            'body' => 'Compliant materials also make these robots potentially safer when interacting directly with humans.'
                        ],
                    ],
                ],
                [
                    'author' => 'Mila Petrović',
                    'body' => 'The challenge seems to be controlling soft structures precisely while preserving their flexibility.',
                    'replies' => [
                        [
                            'author' => 'Sophie Laurent',
                            'body' => 'Embedded sensors and distributed actuation could be important for achieving that balance.'
                        ],
                    ],
                ],
            ],

            'Designing More Efficient Solar Cells' => [
                [
                    'author' => 'Kenji Tanaka',
                    'body' => 'Improving solar-cell efficiency is not simply about absorbing more sunlight. Charge separation and transport losses are also critical.',
                    'replies' => [
                        [
                            'author' => 'Daniel Kim',
                            'body' => 'And stability is often overlooked when comparing new materials. A highly efficient material that degrades quickly may have limited practical value.'
                        ],
                    ],
                ],
                [
                    'author' => 'Dr Elena Petrović',
                    'body' => 'Perovskite materials have generated a lot of interest because of their optical and electronic properties, although durability remains an important research challenge.',
                    'replies' => [
                        [
                            'author' => 'Emily Carter',
                            'body' => 'Manufacturing consistency is another factor that becomes important when moving from laboratory cells to larger-scale production.'
                        ],
                    ],
                ],
            ],

            'Digital Twins for Complex Machines' => [
                [
                    'author' => 'Mr Nikola Jovanović',
                    'body' => 'Digital twins can connect physical systems with continuously updated computational models, which could be valuable for maintenance and monitoring.',
                    'replies' => [
                        [
                            'author' => 'Lucas Miller',
                            'body' => 'The quality of the twin obviously depends on the quality and frequency of the sensor data feeding it.'
                        ],
                    ],
                ],
                [
                    'author' => 'Dr James Anderson',
                    'body' => 'One interesting application is predicting component degradation before a physical failure occurs.',
                    'replies' => [
                        [
                            'author' => 'Aisha Rahman',
                            'body' => 'That could potentially reduce maintenance costs while also improving safety in systems where unexpected failures are expensive.'
                        ],
                    ],
                ],
            ],

            'Why Prime Numbers Matter' => [
                [
                    'author' => 'Dimitrije Savatić',
                    'body' => 'Prime numbers are a great example of mathematics that initially appears purely theoretical but later becomes important in practical technologies such as cryptography.',
                    'replies' => [
                        [
                            'author' => 'Daniel Kim',
                            'body' => 'Their distribution is also surprisingly deep. Even simple questions about how primes are spaced lead to difficult mathematical problems.'
                        ],
                    ],
                ],
                [
                    'author' => 'Dr Tijana Prodanović',
                    'body' => 'The connection between prime numbers and the structure of integers is one of the reasons they remain central to number theory.',
                    'replies' => [
                        [
                            'author' => 'Kenji Tanaka',
                            'body' => 'And the fact that there are infinitely many primes is surprisingly elegant considering how irregular their distribution can appear.'
                        ],
                    ],
                ],
            ],

            'Modeling Networks With Graph Theory' => [
                [
                    'author' => 'Emily Carter',
                    'body' => 'Graph theory provides a useful abstraction because many systems can be represented as nodes and relationships even when their real-world details are very different.',
                    'replies' => [
                        [
                            'author' => 'Oliver Bennett',
                            'body' => 'That makes graph-based approaches useful for everything from transportation networks to biological interactions.'
                        ],
                    ],
                ],
                [
                    'author' => 'Sophie Laurent',
                    'body' => 'The choice of graph representation can strongly affect the analysis. Directed and weighted edges can capture information that a simple graph cannot.',
                    'replies' => [
                        [
                            'author' => 'Mila Petrović',
                            'body' => 'Exactly. The model should preserve the relationships that are relevant to the scientific question being studied.'
                        ],
                    ],
                ],
            ],

            'Mathematical Models and the Limits of Prediction' => [
                [
                    'author' => 'Dr James Anderson',
                    'body' => 'A model can be useful even when it cannot predict every detail of a system. The important question is what assumptions and predictions the model can support.',
                    'replies' => [
                        [
                            'author' => 'Dr Maria Rossi',
                            'body' => 'Uncertainty should therefore be treated as part of the model rather than something that can simply be removed.'
                        ],
                    ],
                ],
                [
                    'author' => 'Ana Marković',
                    'body' => 'Complex systems can also become sensitive to small changes in their initial conditions, which puts practical limits on long-term prediction.',
                    'replies' => [
                        [
                            'author' => 'Mr Nikola Jovanović',
                            'body' => 'Weather and climate models are good examples of why prediction horizons and uncertainty need to be communicated carefully.'
                        ],
                    ],
                ],
            ],

            'Why Negative Results Matter in Science' => [
                [
                    'author' => 'Aisha Rahman',
                    'body' => 'Negative results can prevent other researchers from repeating unsuccessful approaches, but they are often harder to publish than positive findings.',
                    'replies' => [
                        [
                            'author' => 'Dr Elena Petrović',
                            'body' => 'Publication bias can therefore distort the apparent strength of evidence for a particular hypothesis.'
                        ],
                    ],
                ],
                [
                    'author' => 'Lucas Miller',
                    'body' => 'Repositories for negative and null results could make the scientific record much more complete.',
                    'replies' => [
                        [
                            'author' => 'Dimitrije Savatić',
                            'body' => 'It would also be useful if the methodology and experimental conditions were documented in enough detail to explain why the result occurred.'
                        ],
                    ],
                ],
            ],

            'Open Science and the Future of Research' => [
                [
                    'author' => 'Dr Sofia Alvarez',
                    'body' => 'Open access, open data and open-source software can make scientific work easier to verify and build upon.',
                    'replies' => [
                        [
                            'author' => 'Sophie Laurent',
                            'body' => 'There are still practical challenges involving sensitive data, licensing and the cost of maintaining research infrastructure.'
                        ],
                    ],
                ],
                [
                    'author' => 'Daniel Kim',
                    'body' => 'Open-source research software is particularly valuable because future researchers can inspect and improve the methods rather than treating them as black boxes.',
                    'replies' => [
                        [
                            'author' => 'Emily Carter',
                            'body' => 'Documentation and maintenance are important, though. A repository that is public but impossible to reproduce is not very useful.'
                        ],
                    ],
                ],
            ],

            'How to Evaluate a Scientific Claim Online' => [
                [
                    'author' => 'Dimitrije Savatić',
                    'body' => 'One of the most important steps is checking whether the original research actually supports the claim being made online. Headlines often simplify or exaggerate findings.',
                    'replies' => [
                        [
                            'author' => 'Dr Tijana Prodanović',
                            'body' => 'Looking at the study design and sample size can reveal important limitations that are invisible in a short social-media post.'
                        ],
                        [
                            'author' => 'Dr James Anderson',
                            'body' => 'It is also useful to distinguish between an individual study and the broader scientific consensus on a topic.'
                        ],
                    ],
                ],
                [
                    'author' => 'Ana Marković',
                    'body' => 'Checking who funded a study can provide useful context, although funding alone does not determine whether the results are valid.',
                    'replies' => [
                        [
                            'author' => 'Dr Maria Rossi',
                            'body' => 'Exactly. Conflicts of interest should be considered alongside the methodology, data and independent replication.'
                        ],
                    ],
                ],
            ],
        ];

        DB::transaction(function () use ($comments) {
            foreach ($comments as $postTitle => $postComments) {
                $post = Post::where('title', $postTitle)->first();

                if (!$post) {
                    throw new RuntimeException(
                        "Post not found: {$postTitle}"
                    );
                }

                foreach ($postComments as $commentData) {
                    $parent = $this->createComment(
                        post: $post,
                        authorName: $commentData['author'],
                        body: $commentData['body'],
                        parent: null
                    );

                    foreach ($commentData['replies'] ?? [] as $replyData) {
                        $this->createComment(
                            post: $post,
                            authorName: $replyData['author'],
                            body: $replyData['body'],
                            parent: $parent
                        );
                    }
                }
            }
        });
    }

    private function createComment(
        Post $post,
        string $authorName,
        string $body,
        ?Comment $parent
    ): Comment {
        $user = $this->findUser($authorName);

        /*
         * A reply may never be written by the same user
         * who wrote its direct parent.
         */
        if ($parent && $parent->user_id === $user->id) {
            throw new RuntimeException(
                "Invalid nested comment: {$authorName} cannot reply to their own comment."
            );
        }

        return Comment::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'parent_id' => $parent?->id,
            'body' => $body,
        ]);
    }

    private function findUser(string $name): User
    {
        [$firstName, $lastName] = $this->splitName($name);

        $user = User::where('first_name', $firstName)
            ->where('last_name', $lastName)
            ->first();

        if (!$user) {
            throw new RuntimeException(
                "User not found: {$name}"
            );
        }

        return $user;
    }

    private function splitName(string $name): array
    {
        $parts = preg_split('/\s+/', trim($name));

        $lastName = array_pop($parts);
        $firstName = implode(' ', $parts);

        return [$firstName, $lastName];
    }
}
