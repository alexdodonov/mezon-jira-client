<?php
namespace Mezon\Jira\Issue;

/**
 * Jira issue
 *
 * @author gdever
 */
class Issue
{

    /**
     * Connection to Jira
     *
     * @var Connection
     */
    private $connection = null;

    /**
     * Issue data
     *
     * @var object
     */
    private $issue = null;

    /**
     * List of scalar fields
     *
     * @var array
     */
    private $scalarFields = [
        'id',
        'key'
    ];

    /**
     * Constructor
     *
     * @param Connection $connection
     *            connection to Jira
     * @param object $issue
     *            data
     */
    public function __construct(Connection $connection, object $issue)
    {
        $this->connection = $connection;

        $this->issue = $issue;
    }

    /**
     * Method returns fields
     *
     * @param string $name
     *            field name
     * @return mixed field falue
     */
    public function __get(string $name)
    {
        if (in_array($name, $this->scalarFields)) {
            return $this->issue->$name;
        }
    }
}
