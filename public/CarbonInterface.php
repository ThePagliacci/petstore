<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon;

use BadMethodCallException;
use Carbon\Exceptions\BadComparisonUnitException;
use Carbon\Exceptions\ImmutableException;
use Carbon\Exceptions\InvalidDateException;
use Carbon\Exceptions\InvalidFormatException;
use Carbon\Exceptions\UnknownGetterException;
use Carbon\Exceptions\UnknownMethodException;
use Carbon\Exceptions\UnknownSetterException;
use Closure;
use DateInterval;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use JsonSerializable;
use ReflectionException;
use ReturnTypeWillChange;
use Symfony\Component\Translation\TranslatorInterface;
use Throwable;

/**
 * Common interface for Carbon and CarbonImmutable.
 *
 * <autodoc generated by `composer phpdoc`>
 *
 * @property      int              $year
 * @property      int              $yearIso
 * @property      int              $month
 * @property      int              $day
 * @property      int              $hour
 * @property      int              $minute
 * @property      int              $second
 * @property      int              $micro
 * @property      int              $microsecond
 * @property      int|float|string $timestamp                                                                         seconds since the Unix Epoch
 * @property      string           $englishDayOfWeek                                                                  the day of week in English
 * @property      string           $shortEnglishDayOfWeek                                                             the abbreviated day of week in English
 * @property      string           $englishMonth                                                                      the month in English
 * @property      string           $shortEnglishMonth                                                                 the abbreviated month in English
 * @property      int              $milliseconds
 * @property      int              $millisecond
 * @property      int              $milli
 * @property      int              $week                                                                              1 through 53
 * @property      int              $isoWeek                                                                           1 through 53
 * @property      int              $weekYear                                                                          year according to week format
 * @property      int              $isoWeekYear                                                                       year according to ISO week format
 * @property      int              $dayOfYear                                                                         1 through 366
 * @property      int              $age                                                                               does a diffInYears() with default parameters
 * @property      int              $offset                                                                            the timezone offset in seconds from UTC
 * @property      int              $offsetMinutes                                                                     the timezone offset in minutes from UTC
 * @property      int              $offsetHours                                                                       the timezone offset in hours from UTC
 * @property      CarbonTimeZone   $timezone                                                                          the current timezone
 * @property      CarbonTimeZone   $tz                                                                                alias of $timezone
 * @property-read int              $dayOfWeek                                                                         0 (for Sunday) through 6 (for Saturday)
 * @property-read int              $dayOfWeekIso                                                                      1 (for Monday) through 7 (for Sunday)
 * @property-read int              $weekOfYear                                                                        ISO-8601 week number of year, weeks starting on Monday
 * @property-read int              $daysInMonth                                                                       number of days in the given month
 * @property-read string           $latinMeridiem                                                                     "am"/"pm" (Ante meridiem or Post meridiem latin lowercase mark)
 * @property-read string           $latinUpperMeridiem                                                                "AM"/"PM" (Ante meridiem or Post meridiem latin uppercase mark)
 * @property-read string           $timezoneAbbreviatedName                                                           the current timezone abbreviated name
 * @property-read string           $tzAbbrName                                                                        alias of $timezoneAbbreviatedName
 * @property-read string           $dayName                                                                           long name of weekday translated according to Carbon locale, in english if no translation available for current language
 * @property-read string           $shortDayName                                                                      short name of weekday translated according to Carbon locale, in english if no translation available for current language
 * @property-read string           $minDayName                                                                        very short name of weekday translated according to Carbon locale, in english if no translation available for current language
 * @property-read string           $monthName                                                                         long name of month translated according to Carbon locale, in english if no translation available for current language
 * @property-read string           $shortMonthName                                                                    short name of month translated according to Carbon locale, in english if no translation available for current language
 * @property-read string           $meridiem                                                                          lowercase meridiem mark translated according to Carbon locale, in latin if no translation available for current language
 * @property-read string           $upperMeridiem                                                                     uppercase meridiem mark translated according to Carbon locale, in latin if no translation available for current language
 * @property-read int              $noZeroHour                                                                        current hour from 1 to 24
 * @property-read int              $weeksInYear                                                                       51 through 53
 * @property-read int              $isoWeeksInYear                                                                    51 through 53
 * @property-read int              $weekOfMonth                                                                       1 through 5
 * @property-read int              $weekNumberInMonth                                                                 1 through 5
 * @property-read int              $firstWeekDay                                                                      0 through 6
 * @property-read int              $lastWeekDay                                                                       0 through 6
 * @property-read int              $daysInYear                                                                        365 or 366
 * @property-read int              $quarter                                                                           the quarter of this instance, 1 - 4
 * @property-read int              $decade                                                                            the decade of this instance
 * @property-read int              $century                                                                           the century of this instance
 * @property-read int              $millennium                                                                        the millennium of this instance
 * @property-read bool             $dst                                                                               daylight savings time indicator, true if DST, false otherwise
 * @property-read bool             $local                                                                             checks if the timezone is local, true if local, false otherwise
 * @property-read bool             $utc                                                                               checks if the timezone is UTC, true if UTC, false otherwise
 * @property-read string           $timezoneName                                                                      the current timezone name
 * @property-read string           $tzName                                                                            alias of $timezoneName
 * @property-read string           $locale                                                                            locale of the current instance
 *
 * @method        bool             isUtc()                                                                            Check if the current instance has UTC timezone. (Both isUtc and isUTC cases are valid.)
 * @method        bool             isLocal()                                                                          Check if the current instance has non-UTC timezone.
 * @method        bool             isValid()                                                                          Check if the current instance is a valid date.
 * @method        bool             isDST()                                                                            Check if the current instance is in a daylight saving time.
 * @method        bool             isSunday()                                                                         Checks if the instance day is sunday.
 * @method        bool             isMonday()                                                                         Checks if the instance day is monday.
 * @method        bool             isTuesday()                                                                        Checks if the instance day is tuesday.
 * @method        bool             isWednesday()                                                                      Checks if the instance day is wednesday.
 * @method        bool             isThursday()                                                                       Checks if the instance day is thursday.
 * @method        bool             isFriday()                                                                         Checks if the instance day is friday.
 * @method        bool             isSaturday()                                                                       Checks if the instance day is saturday.
 * @method        bool             isSameYear(Carbon|DateTimeInterface|string|null $date = null)                      Checks if the given date is in the same year as the instance. If null passed, compare to now (with the same timezone).
 * @method        bool             isCurrentYear()                                                                    Checks if the instance is in the same year as the current moment.
 * @method        bool             isNextYear()                                                                       Checks if the instance is in the same year as the current moment next year.
 * @method        bool             isLastYear()                                                                       Checks if the instance is in the same year as the current moment last year.
 * @method        bool             isSameWeek(Carbon|DateTimeInterface|string|null $date = null)                      Checks if the given date is in the same week as the instance. If null passed, compare to now (with the same timezone).
 * @method        bool             isCurrentWeek()                                                                    Checks if the instance is in the same week as the current moment.
 * @method        bool             isNextWeek()                                                                       Checks if the instance is in the same week as the current moment next week.
 * @method        bool             isLastWeek()                                                                       Checks if the instance is in the same week as the current moment last week.
 * @method        bool             isSameDay(Carbon|DateTimeInterface|string|null $date = null)                       Checks if the given date is in the same day as the instance. If null passed, compare to now (with the same timezone).
 * @method        bool             isCurrentDay()                                                                     Checks if the instance is in the same day as the current moment.
 * @method        bool             isNextDay()                                                                        Checks if the instance is in the same day as the current moment next day.
 * @method        bool             isLastDay()                                                                        Checks if the instance is in the same day as the current moment last day.
 * @method        bool             isSameHour(Carbon|DateTimeInterface|string|null $date = null)                      Checks if the given date is in the same hour as the instance. If null passed, compare to now (with the same timezone).
 * @method        bool             isCurrentHour()                                                                    Checks if the instance is in the same hour as the current moment.
 * @method        bool             isNextHour()                                                                       Checks if the instance is in the same hour as the current moment next hour.
 * @method        bool             isLastHour()                                                          