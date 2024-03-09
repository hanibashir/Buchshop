<?php

declare(strict_types=1);

namespace Framework;
class Router
{
    private array $routes = [];

    /** Adds routes to the Routing Table */
    public function add(string $path, array $params = []): void
    {
        $this->routes[] = [
            "path" => $path,
            "params" => $params
        ];
    }

    /**
     * Matches the route path to the list of routes in the Routing Table
     * @var $path : extracted from url request. e.g. /home/index
     * /home/index path matches the regex @var $pattern : #^/(?<controller>[a-z]+)/(?<action>[a-z]+)$#
     * Then builtin @method preg_match() @param $matches contains: Array
     *                                                              (
     *                                                                [0] => /home/index
     *                                                                [controller] => home
     *                                                                [1] => home
     *                                                                [action] => index
     *                                                                [2] => index
     *                                                              )
     *
     */
    public function match($path): array|bool
    {
        /**
         * Matches the route path to the list of routes in the Routing Table
         * @var $params ==> e.g. ["controller" => "home", "action" => "index"] or false
         */
        $path = trim(urldecode($path), '/');
        foreach ($this->routes as $route) {
            $pattern = $this->getPatternFromRoutePath($route['path']); # (?<placeholder>[^/]*) for each placeholder

            if (preg_match($pattern, $path, $matches)) {
                # filter $matches to remove non string indexes e.g. [0], [1], etc...
                $matches = array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY);

                # if path contains /products instead of /products/index or /products/id/show, etc..., $matches will be
                # empty. to avoid the error that empty $matches cause, we need to merge the other routes to $matches.
                # $matches will work if path followed this pattern:
                # /{placeholder}/{placeholder} or /{placeholder}/{placeholder}/{placeholder}, etc...
                # $route['params'] contains hardcoded routes added to the routing table by add() function
                # merge the two arrays, because one of them will always contain a valid path.

                return array_merge($matches, $route['params']);
            }
        }
        return false;
    }

    private function getPatternFromRoutePath(string $route_path): string
    {
        /**
         * $route_path === /{placeholder}/{placeholder} or /{placeholder}/{placeholder}/{placeholder}, etc...
         * added by add() function to the routing table.
         * remove any leading or trailing '/'
         */
        $route_path = trim($route_path, '/');
        # $route_path after trim === {placeholder}/{placeholder}
        $segments = explode('/', $route_path); # separate using '/'
        # $segments === Array ([0] => {placeholder}, [1] => {placeholder})

        $segments = array_map(
        # Apply the anonymous function return value to each element of $segments array
            function (string $seg): string {
                # for the route path: {controller}/{action} e.g. /products/show:
                if (preg_match("#^\{([a-z][a-z0-9]*)\}$#", $seg, $matches)) {
                    # $matches ==>
                    # first placeholder: Array( [0] => {controller}, [1] => controller )
                    # second placeholder: Array( [0] => {action}, [1] => action )
                    # set regex capture group name to: $matches[1] e.g. controller or action
                    return "(?<" . $matches[1] . ">[^/]*)";
                }
                # if the route path contains 'id' placeholder like {controller}/{id:\d}/{action} e.g. /products/123/show
                # Convert this {id:\d} to regex: (?<id>\d+) where capture group name is <id> \d+ match one or more numbers.
                if (preg_match("#^\{([a-z][a-z0-9]*):(.+)\}$#", $seg, $matches)) { // this match {id:\d}
                    # $matches ==>
                    # id placeholder: Array( [0] => {id:\d+}, [1] => id, [2] => \d+ )
                    return "(?<" . $matches[1] . ">" . $matches[2] . ")"; # this will this pattern: (?<id>\d+)
                }

                return $seg;
            },
            $segments
        );

        # $segments after map contains === Array([0] => (?<placeholder>[^/]*), [1] => (?<placeholder>[^/]*))
        # e.g. for the route path /{placeholder}/{placeholder}/{placeholder}:
        # $segments === Array( [0] => (?<placeholder>[^/]*), [1] => (?<placeholder>[^/]*), [2] => (?<placeholder>[^/]*))

        /**
         * @method implode() to join the array elemnts using / and return it as string:
         * the original route path: /{placeholder}/{placeholder} or /{placeholder}/{placeholder}/{placeholder}, etc...
         * after @method array_map(): (?<placeholder>[^/]*), [1] => (?<placeholder>[^/]*)
         * the final regex this function will return:
         * #^(?<placeholder>[^/]*)/(?<placeholder>[^/]*)$#i
         *                      or
         * #^(?<placeholder>[^/]*)/(?<placeholder>[^/]*)/(?<placeholder>[^/]*)$#i etc...
         * regex: i for ignore case, u for unicode to match non english chars
         */

        return "#^" . implode('/', $segments) . "$#iu";
    }
}