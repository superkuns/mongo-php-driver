<?php

namespace MongoDB\Query;

/**
 * Value object corresponding to a wire protocol OP_QUERY message.
 *
 * If and when queries become commands, we will need to introduce a new Query
 * object, such as QueryCommand. At that point, the query will likely be
 * constructed from a single document, which includes the arguments below in a
 * similar fashion to findAndModify.
 */
final class Query
{
    // See: http://docs.mongodb.org/meta-driver/latest/legacy/mongodb-wire-protocol/#op-query
    const FLAG_TAILABLE_CURSOR   = 0x01;
    const FLAG_SLAVE_OK          = 0x02;
    const FLAG_OPLOG_REPLAY      = 0x04;
    const FLAG_NO_CURSOR_TIMEOUT = 0x08;
    const FLAG_AWAIT_DATA        = 0x10;
    const FLAG_EXHAUST           = 0x20;
    const FLAG_PARTIAL           = 0x40;

    private $query;
    private $selector;
    private $flags;
    private $skip;
    private $limit;

    /**
     * Constructs a new Query
     *
     * @param array|object $query    Query document
     * @param array|object $selector Selector document
     * @param integer      $flags    Query flags
     * @param integer      $skip     Skip
     * @param integer      $limit    Limit
     */
    public function __construct($query, $selector, $flags, $skip, $limit)
    {
        $this->query = $query;
        $this->selector = $selector;
        $this->flags = (integer) $flags;
        $this->skip = (integer) $skip;
        $this->limit = (integer) $limit;
    }
}
