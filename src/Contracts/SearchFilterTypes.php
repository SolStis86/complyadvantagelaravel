<?php


namespace SolStis86\ComplyAdvantage\Contracts;


interface SearchFilterTypes
{
    const TYPE_SANCTION = 'sanction';
    const TYPE_WARNING = 'warning';
    const TYPE_FITNESS_PROBITY = 'fitness-probity';
    const TYPE_PEP = 'pep';
    const TYPE_PEP_CLASS_1 = 'pep-class-1';
    const TYPE_PEP_CLASS_2 = 'pep-class-2';
    const TYPE_PEP_CLASS_3 = 'pep-class-3';
    const TYPE_PEP_CLASS_4 = 'pep-class-4';
    const TYPE_ADVERSE_MEDIA = 'adverse-media';
    const TYPE_ADVERSE_MEDIA_FINANCIAL_CRIME = 'adverse-media-financial-crime';
    const TYPE_ADVERSE_MEDIA_VIOLENT_CRIME = 'adverse-media-violent-crime';
    const TYPE_ADVERSE_MEDIA_SEXUAL_CRIME = 'adverse-media-sexual-crime';
    const TYPE_ADVERSE_MEDIA_TERRORISM = 'adverse-media-terrorism';
    const TYPE_ADVERSE_MEDIA_FRAUD = 'adverse-media-fraud';
    const TYPE_ADVERSE_MEDIA_NARCOTICS = 'adverse-media-narcotics';
    const TYPE_ADVERSE_MEDIA_GENERAL = 'adverse-media-general';
}