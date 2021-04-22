<?php

namespace App\DataFixtures\Provider;

class OneRmProvider
{

    private $UserName = [
        'sangoku',
        'naruto',
        'vegeta',
        'tsubasa',
        'superman',
        'batman',
        'raphael',
        'terence',
        'laurie',
        'charlie'
    ];


    //Nom des exercices
    private $ExerciseName = [
        'Clean and jerk',
        'Deadlift',
        'sumo deadlift ',
        'Front squat',
        'Back squat',
        'strictpress',
        'Overhead squat',
        'Power clean',
        'Push press',
        'Snatch',
        'squat clean',
        'Butterfly pull-up',
        'Sit-up',
        'Push-up',
        'Hand-stand push-up',
        'Wall-ball',
    ];

    private $ExerciseIllustration = [
        
        'clean-and-jerk.jpg',
        'deadlift.jpeg',
        'sumo-deadlift.png',
        'front-squat.jpg',
        'back-squat.jpg',
        'strictpress.jpg',
        'overhead-squat.jpg',
        'power-clean.jpg',
        'push-press.jpg',
        'snatch.jpeg',
        'squat-clean.jpeg',
        'butterfly-pull-up.jpg',
        'sit-up.jpg',
        'push-up.jpg',
        'hand-stand-push-up.jpg',
        'wall-ball.jpg',

    ];

    // Difficulté des exercices
    private $ExerciseDiffuclty = [
        '3',
        '1',
        '1',
        '2',
        '2',
        '3',
        '5',
        '4',
        '2',
        '3',
        '4',
        '4',
        '1',
        '1',
        '5',
        '1',
        '1',
    ];


    //Conseils de realisation
    private $advice = [
        "Le 'Clean and Jerk' ou Epaulé-Jeté est un mouvement olympique d'haltérophilie.",
        "Il permet en deux mouvements d'amener une barre très lourde au dessus de la tête.",
        "Le soulevé de terre (deadlift en anglais) est un mouvement de powerlifting très efficace qui permet de travailler quasiment tous les grands groupes musculaires du corps.",
        "Certainement la variante la plus connue, extrêmement plébiscitée des Powerlifters, vous savez, ces grands messieurs très musclés qui soulèvent très lourd ! La différence majeure entre un soulevé de terre classique et un sumo deadlift réside dans la position des pieds, ceux-ci sont espacés plus largement, à la manière des sumos. L’avantage principal, c’est que la barre a moins de chemin à parcourir jusqu’au point culminant du mouvement, on peut donc charger plus ! Mais ce n’est pas tout, il y a aussi une petite variante de cette variante ! Le sumo deadlift pull, qui consiste à ajouter en fin de mouvement un tirage de la barre en direction du menton ! Ils sont fous ces sumos !",
        "Le front squat est une variante de l'exercice de squat traditionnel qui consiste à réaliser le mouvement avec la barre devant soi. Il permet de travailler principalement les quadriceps (droit fémoral, vaste intermédiaire, vaste médial et latéral).",
        "Le back squat en Crossfit correspond à un exercice de base pour développer en priorité les quadriceps mais aussi les muscles fessiers et les adducteurs. ... Cet exercice se pratique en position debout avec un écartement des pieds équivalent à la largeur du bassin.",
        "Le strict press, également appelé shoulder press, est un exercice purement de force et de musculation. Plus précisément, il cible les muscles des épaules et développe la force de poussée au-dessus de la tête. ... La barre doit se positionner directement au-dessus de vos épaules.",
        "Genoux fléchis, le dos bien droit, l'overhead squat en Crossfit consiste à porter une barre, chargée de disques de fonte, au-dessus de sa tête en conservant les bras écartés et tendus. ... Il sollicite alors les muscles profonds du dos, condition sinequanone pour que la barre n'oscille pas.",
        "Le Power Clean ou Clean est l'une des meilleures méthodes pour gagner en force et en masse musculaire dans l'univers du Crossfit et d'autres programmes de salle de sport. Il s'agit d'un exercice de puissance qui consiste à soulever une barre du sol vers l'avant des épaules, avec l'aide de tout le corps.",
        "Un incontournable des metcons, le push press ressemble au strict press, mais fait appel au bas du corps. Vous devez initier un push press avec un dip dans les jambes, puis transférer cet élan dans vos bras pour soulever la barre des épaules vers une position verrouillée overhead.",
        "L'arraché en musculation (Snatch) est un des deux mouvements techniques de la musculation et plus spécifiquement de l'haltérophilie, qui consiste à soulever une barre comprenant des charges diverses, se trouvant au sol, au-dessus de la tête, en un seul et même mouvement vif. On peut aisément parler de propulsion.",
        "Le squat clean est un mélange de power clean et de squat il consiste à tirer la barre trés fort vers le haut tout en chutant en squat pour réceptionner la bar",
        "Les Butterfly Pull-ups, ou tractions « papillon », ont beaucoup d’avantages dont vous ne profiterez qu’en ayant la bonne technique. Elles peuvent vous aider à économiser de l’énergie, à gagner du temps et à faire plus de répétitions, ainsi qu’à augmenter vos performances pour les amener à un niveau de compétition. Vous trouverez ci-dessous une décomposition complète de ce mouvement qui devrait vous aider à faire plus de séries de Butterfly Pull-ups de manière sécuritaire.",
        "Mettez-vous en position assise, tronc à la verticale, mains derrière la nuque, genoux fléchis (90°) et les pieds à plat sur le tapis.
        A partir de cette position allongez-vous sur le dos, les épaules en contact avec le sol, puis redressez-vous en position assise en portant les coudes vers l'avant en contact avec les genoux,
        Les mains doivent rester jointes derrière la nuque durant tout l'exercice.
        Au commandement Prêt... partez!, répétez ce mouvement aussi rapidement que possible durant 30 secondes
        Continuez jusqu'au commandement Stop",
        "Adopter le bon positionnement pour faire des pompes est à la portée de tous.
        Même un débutant peut facilement effectuer les mouvements adéquats.
        Quoi qu’il en soit, il faut bien suivre les consignes à la lettre pour éviter les blessures.
        Les pompes dites classiques doivent être réalisées sur un terrain plat et solide.
        Pour commencer, installez-vous face au sol, avec les jambes et les bras un peu écartés. Prenez alors appui sur la pointe des pieds et sur la paume des mains.
        Effectuez ensuite des flexions avec vos bras pour descendre tout doucement jusqu’à ce que votre poitrine effleure le sol.
        En faisant en sorte d’effectuer des mouvements fluides et sans à-coups, remontez doucement en poussant avec vos bras pour revenir à la position précédente. ",
        "Placez vos mains à environ un pied d’un mur. Trop proche et le mouvement devient plus difficile à coordonner et vous perdrez plus facilement l’équilibre. Trop loin et vous mettrez votre corps dans une position inefficace pour effectuer toute la gamme de mouvement. En compétition, vous serez peut-être obligé d’avoir vos mains dans des positions particulières,  il vaut mieux s’entraîner avec les mains très près du mur. Cela rend l’exercice beaucoup plus difficile, mais cela vous rendra plus fort et plus coordonné",
        "Composante essentielle du Crossfit, le wall ball est un exercice sportif complet, qui sollicite pratiquement tous les muscles du corps. Il s’agit de lancer en hauteur une balle imposante et assez lourde, afin d’atteindre un objectif fixé, et de répéter l’opération environ 150 fois à la suite. Il existe plusieurs niveaux dans la pratique du wall ball. Les débutants pourront commencer avec une balle légère, tandis que les sportifs les plus entrainés peuvent lancer des balles de plus de 9 kg. Dans ce guide, vous trouverez tout ce qu’il savoir sur les critères de choix d’un wall ball, les avantages de cet exercice, ainsi que les différentes manières d’agrémenter et de diversifier la pratique.",
        "Tout comme la plupart des mouvements de musculation, le swing avec kettlebell nécessite une parfaite technique d’exécution, afin d’éviter tout risque de blessure. Notre premier conseil sera de répéter cet exercice avec une kettlebell légère jusqu’à ce que vous le maîtrisiez parfaitement, avant d’utiliser des poids plus lourds. Si vous maîtrisez déjà le mouvement de soulevé de terre (ou deadlift), vous verrez que la réalisation du kettlebell swing se rapproche de cet exercice, notamment de part le mouvement d’extension de la hanche.",
    ];

 
    /**
     * Retourne un exercice
     */
    public function exerciseName($i)
    {
        return $this->ExerciseName[$i];
    }

    /**
     * Retourne l'illustration de l'exercice
     */
    public function illustration($i)
    {
        return $this->ExerciseIllustration[$i];
    }
    /**
     * Retourne une diffculté
     */
    public function difficulty($i)
    {
        return $this->ExerciseDiffuclty[$i];
    }

    /**
     * Retourne un métier au hasard
     */
    public function advice($i)
    {
        return $this->advice[$i];
    }

    public function username($i)
    {
        return $this->UserName[$i];
    }

}
