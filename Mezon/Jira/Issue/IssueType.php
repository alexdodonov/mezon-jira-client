<?php
namespace Mezon\Jira\Issue;

/**
 * Jira issue type
 *
 * @author gdever
 */
class IssueType
{

    /**
     * Issue type data
     *
     * @var object
     */
    private $issueType = null;
    
    /**
     * List of scalar fields
     *
     * @var array
     */
    private $scalarFields = [
        'id',
        'name'
    ];

    /**
     * Constructor
     *
     * @param string $name
     *            name of the issue type
     */
    public function __construct(string $name = '')
    {
        $this->issueType = new \stdClass();

        $this->issueType->name = $name;
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
        if (in_array($name, $this->scalarFields) && $this->issueType !== null) {
            return $this->issueType->$name;
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
            $this->issueType->$name = $value;
        }
    }
}
