<?php
namespace Mezon\Jira\Project;

/**
 * Jira project
 *
 * @author gdever
 */
class Project
{

    /**
     * Connection to Jira
     *
     * @var Connection
     */
    private $connection = null;

    /**
     * Project data
     *
     * @var object
     */
    private $project = null;

    /**
     * List of scalar fields
     *
     * @var array
     */
    private $scalarFields = [
        'id',
        'key',
        'name',
        'isPrivate',
        'projectTypeKey',
        'style'
    ];

    /**
     * Constructor
     *
     * @param Connection $connection
     *            connection to Jira
     * @param object $project
     *            data
     */
    public function __construct(Connection $connection, object $project)
    {
        $this->connection = $connection;

        $this->project = $project;
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
            return $this->project->$name;
        }

        return null;
    }
}
