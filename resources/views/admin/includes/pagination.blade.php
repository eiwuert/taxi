{{ parse_str(isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '', $query) }}
{{ $resource->appends($query)->links() }}
