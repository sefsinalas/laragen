<?php namespace Mayconbordin\Generator\FormDumpers;

use Mayconbordin\Generator\Generator\Stub;
use Mayconbordin\Generator\Parsers\SchemaParser;

class FieldsDumper
{
    use StubTrait;

    /**
     * The form fields.
     *
     * @var string
     */
    protected $fields;

    /**
     * The constructor.
     *
     * @param string $fields
     */
    public function __construct($fields)
    {
        $this->fields = $fields;
    }

    /**
     * Render the form.
     *
     * @return string
     */
    public function render()
    {
        $results = '';

        foreach ((new SchemaParser())->parse($this->fields) as $field) {
            $results .= $this->getStub($field->getType(), $field->getName()).PHP_EOL;
        }

        return $results;
    }

    /**
     * Convert the fields to html heading.
     *
     * @return string
     */
    public function toHeading()
    {
        $results = '';

        foreach ((new SchemaParser())->parse($this->fields) as $field) {
            if (in_array($field->getName(), $this->ignores)) {
                continue;
            }

            $results .= "\t\t\t".'<th>'.ucwords($field->getName()).'</th>'.PHP_EOL;
        }

        return $results;
    }

    /**
     * Convert the fields to formatted php script.
     *
     * @param string $var
     *
     * @return string
     */
    public function toBody($var)
    {
        $results = '';

        foreach ((new SchemaParser())->parse($this->fields) as $field) {
            if (in_array($field->getName(), $this->ignores)) {
                continue;
            }

            $results .= "\t\t\t\t\t".'<td>{!! $'.$var.'->'.$field->getName().' !!}</td>'.PHP_EOL;
        }

        return $results;
    }

    /**
     * Get replacements for $SHOW_BODY$.
     *
     * @param string $var
     *
     * @return string
     */
    public function toRows($var)
    {
        $results = PHP_EOL;

        foreach ((new SchemaParser())->parse($this->fields) as $field) {
            if (in_array($field->getName(), $this->ignores)) {
                continue;
            }

            $results .= Stub::createFromPath(__DIR__.'/../Stubs/scaffold/row.stub', [
                'label' => ucwords($field->getName()),
                'column' => $field->getName(),
                'var' => $var,
            ])->render();
        }

        return $results.PHP_EOL;
    }
}
