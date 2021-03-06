<?php

declare(strict_types=1);

namespace Tests\BestIt\Sniffs\Commenting;

use BestIt\Sniffs\Commenting\GeneralDocSniff;
use PHP_CodeSniffer_File;
use Tests\BestIt\SniffTestCase;

/**
 * Class GeneralDocSniff
 *
 * @package Tests\BestIt\Sniffs\Commenting
 * @author Nick Lubisch <nick.lubisch@bestit-online.de>
 */
class GeneralDocSniffTest extends SniffTestCase
{
    /**
     * Test that the given files contain no errors.
     *
     * @param string $file Provided file to test
     *
     * @return void
     *
     * @dataProvider getCorrectFileList
     */
    public function testCorrect(string $file)
    {
        $this->assertFileCorrect($file);
    }

    /**
     * Test much lines before comment and fix.
     *
     * @return void
     */
    public function testMuchLinesBeforeComment()
    {
        $report = $this->checkSniffFile(__DIR__ . '/Fixtures/GeneralDocSniff/MuchLinesBeforeComment.php');

        $this->assertSniffError(
            $report,
            4,
            GeneralDocSniff::CODE_MANY_LINES_BEFORE_COMMENT
        );

        $this->assertSniffError(
            $report,
            11,
            GeneralDocSniff::CODE_MANY_LINES_BEFORE_COMMENT
        );

        $this->assertSniffError(
            $report,
            19,
            GeneralDocSniff::CODE_MANY_LINES_BEFORE_COMMENT
        );

        $this->assertSniffError(
            $report,
            31,
            GeneralDocSniff::CODE_MANY_LINES_BEFORE_COMMENT
        );

        $this->assertSniffError(
            $report,
            40,
            GeneralDocSniff::CODE_MANY_LINES_BEFORE_COMMENT
        );

        $this->assertAllFixedInFile($report);
    }

    /**
     * Test much lines before comment and fix.
     *
     * @return void
     */
    public function testNoLineBeforeComment()
    {
        $report = $this->checkSniffFile(__DIR__ . '/Fixtures/GeneralDocSniff/NoLineBeforeComment.php');

        $this->assertSniffError(
            $report,
            2,
            GeneralDocSniff::CODE_NO_LINE_BEFORE_COMMENT
        );

        $this->assertSniffError(
            $report,
            13,
            GeneralDocSniff::CODE_NO_LINE_BEFORE_COMMENT
        );

        $this->assertSniffError(
            $report,
            30,
            GeneralDocSniff::CODE_NO_LINE_BEFORE_COMMENT
        );

        $this->assertAllFixedInFile($report);
    }

    /**
     * Test much lines before comment and fix.
     *
     * @return void
     */
    public function testWrongCommentTagSpacing()
    {
        $report = $this->checkSniffFile(__DIR__ . '/Fixtures/GeneralDocSniff/WrongCommentTagSpacing.php');

        $this->assertSniffError(
            $report,
            6,
            GeneralDocSniff::CODE_WRONG_COMMENT_TAG_SPACING
        );

        $this->assertSniffError(
            $report,
            13,
            GeneralDocSniff::CODE_WRONG_COMMENT_TAG_SPACING
        );

        $this->assertSniffError(
            $report,
            20,
            GeneralDocSniff::CODE_WRONG_COMMENT_TAG_SPACING
        );

        $this->assertSniffError(
            $report,
            21,
            GeneralDocSniff::CODE_WRONG_COMMENT_TAG_SPACING
        );

        $this->assertSniffError(
            $report,
            30,
            GeneralDocSniff::CODE_WRONG_COMMENT_TAG_SPACING
        );

        $this->assertAllFixedInFile($report);
    }

    /**
     * Checks the given file with defined error codes.
     *
     * @param string $file Filename of the fixture
     * @param array $sniffProperties Array of sniff properties
     *
     * @return PHP_CodeSniffer_File The php cs file
     */
    protected function checkSniffFile(string $file, array $sniffProperties = []): PHP_CodeSniffer_File
    {
        return $this->checkFile(
            $file,
            $sniffProperties,
            [
                GeneralDocSniff::CODE_NO_LINE_BEFORE_COMMENT,
                GeneralDocSniff::CODE_MANY_LINES_BEFORE_COMMENT,
                GeneralDocSniff::CODE_WRONG_COMMENT_TAG_SPACING
            ]
        );
    }
}
