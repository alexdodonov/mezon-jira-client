<?php
namespace Mezon\Jira\Issue;

use Mezon\Jira\ConnectionMethods;
use Mezon\Jira\Connection;

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
     * Setting id
     *
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->issue->id = $id;
    }

    /**
     * Getting id
     *
     * @return int
     */
    public function getId(): int
    {
        if (! isset($this->issue->id)) {
            throw (new \Exception('Field "id"  was not found for the issue'));
        }

        return $this->issue->id;
    }

    /**
     * Setting summary
     *
     * @param string $summary
     *            summary
     */
    public function setSummary(string $summary): void
    {
        $this->issue->summary = $summary;
    }

    /**
     * Getting summary
     *
     * @return string summary
     */
    public function getSummary(): string
    {
        if (! isset($this->issue->summary)) {
            throw (new \Exception('Field "summary"  was not found for the issue'));
        }

        return $this->issue->summary;
    }

    /**
     * Setting description
     *
     * @param string $description
     *            description
     */
    public function setDescription(string $description): void
    {
        if (! isset($this->issue->description)) {
            $this->issue->description = new \stdClass();
            $this->issue->description->type = 'doc';
            $this->issue->description->version = 1;
        }

        $content = new \stdClass();
        $content->text = $description;
        $content->type = 'text';

        $paragraph = new \stdClass();
        $paragraph->type = 'paragraph';
        $paragraph->content = [];
        $paragraph->content[] = $content;

        $this->issue->description->content = [];
        $this->issue->description->content[] = $paragraph;
    }

    /**
     * Getting description
     *
     * @return object description
     */
    public function getDescription(): object
    {
        if (! isset($this->issue->description)) {
            throw (new \Exception('Field "description"  was not found for the issue'));
        }

        return $this->issue->description;
    }

    /**
     * Setting project key
     *
     * @param string $projectKey
     *            project key
     */
    public function setProjectKey(string $projectKey): void
    {
        if (! isset($this->issue->project)) {
            $this->issue->project = new \stdClass();
        }

        $this->issue->project->key = $projectKey;
    }

    /**
     * Getting project key
     *
     * @return string project key
     */
    public function getProjectKey(): string
    {
        if (! isset($this->issue->project) || ! isset($this->issue->project->key)) {
            throw (new \Exception('Field "project->key" was not found for the issue'));
        }

        return $this->issue->project->key;
    }

    /**
     * Getting project
     *
     * @return object project
     */
    public function getProject(): object
    {
        if (! isset($this->issue->project)) {
            throw (new \Exception('Field "project" was not found for the issue'));
        }

        return $this->issue->project;
    }

    /**
     * Setting issue type name
     *
     * @param string $issueTypeName
     *            issue type name
     */
    public function setIssueTypeName(string $issueTypeName): void
    {
        if (! isset($this->issue->issueType)) {
            $this->issue->issueType = new \stdClass();
        }

        $this->issue->issueType->name = $issueTypeName;
    }

    /**
     * Getting issue type name
     *
     * @return string issue type name
     */
    public function getIssueTypeName(): string
    {
        if (! isset($this->issue->issueType) || ! isset($this->issue->issueType->name)) {
            throw (new \Exception('Field "issueType->name" was not found for the issue'));
        }

        return $this->issue->issueType->name;
    }

    /**
     * Getting issue type
     *
     * @return object issue type
     */
    public function getIssueType(): object
    {
        if (! isset($this->issue->issueType)) {
            throw (new \Exception('Field "issueType" was not found for the issue'));
        }

        return $this->issue->issueType;
    }

    /**
     * Method creates issue
     */
    public function create(): void
    {
        $this->getConnection()->sendPostRequest('/issue', [
            'fields' => [
                'project' => $this->getProject(),
                'summary' => $this->getSummary(),
                'description' => $this->getDescription(),
                'issuetype' => $this->getIssueType()
            ]
        ]);
    }
}
