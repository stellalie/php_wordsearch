## To run

Tested using php that comes out of the box on my OSX

To run `php index.php input.txt`

```
>> php -version

PHP 7.1.23 (cli) (built: Feb 22 2019 22:19:32) ( NTS )
Copyright (c) 1997-2018 The PHP Group
Zend Engine v3.1.0, Copyright (c) 1998-2018 Zend Technologies

>>  php index.php Sample-A.txt
``` 

Sample results

```
 php_wordsearch ✖ php index.php Sample-A.txt
  0  1  2  3  4  5  6  7  8  9
0 V  K  N  C  T  Y  E  E  S  Q
1 B  C  A  H  R  R  T  G  I  Q
2 I  O  S  A  E  E  R  U  L  D
3 S  R  H  R  N  M  O  O  O  R
4 M  E  V  L  T  O  F  R  P  O
5 A  L  I  E  O  G  K  N  A  F
6 R  T  L  S  N  T  N  O  N  T
7 C  T  L  T  V  N  A  T  N  R
8 K  I  E  O  L  O  R  A  A  A
9 S  L  O  N  X  M  F  B  N  H 

FRANKFORT [9, 6] [8, 6] [7, 6] [6, 6] [5, 6] [4, 6] [3, 6] [2, 6] [1, 6] 
BISMARCK [1, 0] [2, 0] [3, 0] [4, 0] [5, 0] [6, 0] [7, 0] [8, 0] 
BATONROUGE [9, 7] [8, 7] [7, 7] [6, 7] [5, 7] [4, 7] [3, 7] [2, 7] [1, 7] [0, 7] 
NASHVILLE [0, 2] [1, 2] [2, 2] [3, 2] [4, 2] [5, 2] [6, 2] [7, 2] [8, 2] 
LITTLEROCK [9, 1] [8, 1] [7, 1] [6, 1] [5, 1] [4, 1] [3, 1] [2, 1] [1, 1] [0, 1] 
HARTFORD [9, 9] [8, 9] [7, 9] [6, 9] [5, 9] [4, 9] [3, 9] [2, 9] 
ANNAPOLIS [8, 8] [7, 8] [6, 8] [5, 8] [4, 8] [3, 8] [2, 8] [1, 8] [0, 8] 
CHARLESTON [0, 3] [1, 3] [2, 3] [3, 3] [4, 3] [5, 3] [6, 3] [7, 3] [8, 3] [9, 3] 
TRENTON [0, 4] [1, 4] [2, 4] [3, 4] [4, 4] [5, 4] [6, 4] 
MONTGOMERY [9, 5] [8, 5] [7, 5] [6, 5] [5, 5] [4, 5] [3, 5] [2, 5] [1, 5] [0, 5] 

1576734803.0068 - 1576734803.0052 = 1ms
10 unique words

```