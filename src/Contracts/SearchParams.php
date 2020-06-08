<?php


namespace SolStis86\ComplyAdvantage\Contracts;


interface SearchParams
{
    const PARAM_SEARCH_TERM = 'search_term';
    const PARAM_CLIENT_REF = 'client_ref';
    const PARAM_SEARCH_PROFILE = 'search_profile';
    const PARAM_FUZZINESS = 'fuzziness';
    const PARAM_OFFSET = 'offset';
    const PARAM_LIMIT = 'limit';
    const PARAM_FILTERS = 'filters';
    const PARAM_TAGS = 'tags';
    const PARAM_SHARE_URL = 'share_url';
    const PARAM_COUNTRY_CODES = 'country_codes';
    const PARAM_EXACT_MATCH = 'exact_match';
}
