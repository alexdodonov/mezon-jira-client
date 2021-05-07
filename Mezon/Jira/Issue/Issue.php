<?php
namespace Mezon\Jira\Issue;

use Mezon\Jira\ConnectionMethods;

/**
 * Jira issue
 *
 * @author gdever
 */
class Issue
{

    use ConnectionMethods;

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
        'key',
        'summary',
        'description'
    ];

    /**
     * Non scalar fields
     * 
     * @var array
     */
    private $nonScalarFields = [
        'issuetype'
    ];

    /**
     * Constructor
     *
     * @param Connection $connection
     *            connection to Jira
     * @param object $issue
     *            data
     */
    public function __construct(Connection $connection)
    {
        $this->setConnection($connection);

        $this->issue = new \stdClass();
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

        return null;
    }

    /**
     * Method sets field
     *
     * @param string $name
     *            name of the setting field
     * @param mixed $value
     *            setting value
     */
    public function __set(string $name, $value): void
    {
        if (in_array($name, $this->scalarFields)) {
            $this->issue->$name = $value;
        }
    }

    /**
     * Method creates issue
     */
    public function create(): void
    {
        $this->getConnection()->send
    }
}
