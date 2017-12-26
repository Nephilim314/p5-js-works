

```python
import pandas as pd
import numpy
import matplotlib.pyplot as plt
```


```python
df = pd.read_csv("/Users/DarkWizard/Downloads/developer_survey_2017/survey_results_public.csv")
```


```python
df = df.rename(lambda x: x.lower(), axis='columns')
df
```




<div>
<style scoped>
    .dataframe tbody tr th:only-of-type {
        vertical-align: middle;
    }

    .dataframe tbody tr th {
        vertical-align: top;
    }

    .dataframe thead th {
        text-align: right;
    }
</style>
<table border="1" class="dataframe">
  <thead>
    <tr style="text-align: right;">
      <th></th>
      <th>respondent</th>
      <th>professional</th>
      <th>programhobby</th>
      <th>country</th>
      <th>university</th>
      <th>employmentstatus</th>
      <th>formaleducation</th>
      <th>majorundergrad</th>
      <th>homeremote</th>
      <th>companysize</th>
      <th>...</th>
      <th>stackoverflowmakemoney</th>
      <th>gender</th>
      <th>highesteducationparents</th>
      <th>race</th>
      <th>surveylong</th>
      <th>questionsinteresting</th>
      <th>questionsconfusing</th>
      <th>interestedanswers</th>
      <th>salary</th>
      <th>expectedsalary</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>0</th>
      <td>1</td>
      <td>Student</td>
      <td>Yes, both</td>
      <td>United States</td>
      <td>No</td>
      <td>Not employed, and not looking for work</td>
      <td>Secondary school</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>...</td>
      <td>Strongly disagree</td>
      <td>Male</td>
      <td>High school</td>
      <td>White or of European descent</td>
      <td>Strongly disagree</td>
      <td>Strongly agree</td>
      <td>Disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>1</th>
      <td>2</td>
      <td>Student</td>
      <td>Yes, both</td>
      <td>United Kingdom</td>
      <td>Yes, full-time</td>
      <td>Employed part-time</td>
      <td>Some college/university study without earning ...</td>
      <td>Computer science or software engineering</td>
      <td>More than half, but not all, the time</td>
      <td>20 to 99 employees</td>
      <td>...</td>
      <td>Strongly disagree</td>
      <td>Male</td>
      <td>A master's degree</td>
      <td>White or of European descent</td>
      <td>Somewhat agree</td>
      <td>Somewhat agree</td>
      <td>Disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>37500.000000</td>
    </tr>
    <tr>
      <th>2</th>
      <td>3</td>
      <td>Professional developer</td>
      <td>Yes, both</td>
      <td>United Kingdom</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer science or software engineering</td>
      <td>Less than half the time, but at least one day ...</td>
      <td>10,000 or more employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A professional degree</td>
      <td>White or of European descent</td>
      <td>Somewhat agree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>113750.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>3</th>
      <td>4</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>Yes, both</td>
      <td>United States</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Doctoral degree</td>
      <td>A non-computer-focused engineering discipline</td>
      <td>Less than half the time, but at least one day ...</td>
      <td>10,000 or more employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A doctoral degree</td>
      <td>White or of European descent</td>
      <td>Agree</td>
      <td>Agree</td>
      <td>Somewhat agree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>4</th>
      <td>5</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>Switzerland</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Master's degree</td>
      <td>Computer science or software engineering</td>
      <td>Never</td>
      <td>10 to 19 employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>5</th>
      <td>6</td>
      <td>Student</td>
      <td>Yes, both</td>
      <td>New Zealand</td>
      <td>Yes, full-time</td>
      <td>Not employed, and not looking for work</td>
      <td>Secondary school</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>...</td>
      <td>Disagree</td>
      <td>NaN</td>
      <td>A bachelor's degree</td>
      <td>White or of European descent</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>6</th>
      <td>7</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>Yes, both</td>
      <td>United States</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Master's degree</td>
      <td>A non-computer-focused engineering discipline</td>
      <td>Less than half the time, but at least one day ...</td>
      <td>20 to 99 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A doctoral degree</td>
      <td>White or of European descent</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>7</th>
      <td>8</td>
      <td>Professional developer</td>
      <td>Yes, both</td>
      <td>Poland</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Master's degree</td>
      <td>Computer science or software engineering</td>
      <td>All or almost all the time (I'm full-time remote)</td>
      <td>Fewer than 10 employees</td>
      <td>...</td>
      <td>Somewhat agree</td>
      <td>Male</td>
      <td>A master's degree</td>
      <td>White or of European descent</td>
      <td>Agree</td>
      <td>Somewhat agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>8</th>
      <td>9</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>Colombia</td>
      <td>Yes, part-time</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer science or software engineering</td>
      <td>Less than half the time, but at least one day ...</td>
      <td>5,000 to 9,999 employees</td>
      <td>...</td>
      <td>Strongly disagree</td>
      <td>Male</td>
      <td>A bachelor's degree</td>
      <td>Hispanic or Latino/Latina</td>
      <td>Somewhat agree</td>
      <td>Strongly agree</td>
      <td>Disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>9</th>
      <td>10</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>France</td>
      <td>Yes, full-time</td>
      <td>Independent contractor, freelancer, or self-em...</td>
      <td>Master's degree</td>
      <td>Computer science or software engineering</td>
      <td>It's complicated</td>
      <td>NaN</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A doctoral degree</td>
      <td>White or of European descent</td>
      <td>Somewhat agree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>10</th>
      <td>11</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>Yes, I program as a hobby</td>
      <td>United States</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>A social science</td>
      <td>All or almost all the time (I'm full-time remote)</td>
      <td>100 to 499 employees</td>
      <td>...</td>
      <td>Strongly disagree</td>
      <td>Female</td>
      <td>Some college/university study, no bachelor's d...</td>
      <td>White or of European descent</td>
      <td>Strongly disagree</td>
      <td>Agree</td>
      <td>Strongly disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>11</th>
      <td>12</td>
      <td>Professional developer</td>
      <td>No</td>
      <td>Canada</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer science or software engineering</td>
      <td>A few days each month</td>
      <td>100 to 499 employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>12</th>
      <td>13</td>
      <td>Used to be a professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>United Kingdom</td>
      <td>No</td>
      <td>Not employed, but looking for work</td>
      <td>Bachelor's degree</td>
      <td>Mathematics or statistics</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>...</td>
      <td>Strongly disagree</td>
      <td>Male</td>
      <td>A bachelor's degree</td>
      <td>White or of European descent</td>
      <td>Disagree</td>
      <td>Somewhat agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>13</th>
      <td>14</td>
      <td>Professional developer</td>
      <td>Yes, both</td>
      <td>Germany</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Some college/university study without earning ...</td>
      <td>Computer science or software engineering</td>
      <td>Less than half the time, but at least one day ...</td>
      <td>Fewer than 10 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Female</td>
      <td>A master's degree</td>
      <td>Hispanic or Latino/Latina</td>
      <td>Somewhat agree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>14</th>
      <td>15</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>United Kingdom</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Professional degree</td>
      <td>Computer engineering or electrical/electronics...</td>
      <td>All or almost all the time (I'm full-time remote)</td>
      <td>5,000 to 9,999 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>High school</td>
      <td>White or of European descent</td>
      <td>Somewhat agree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>100000.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>15</th>
      <td>16</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>United States</td>
      <td>Yes, part-time</td>
      <td>Independent contractor, freelancer, or self-em...</td>
      <td>Primary/elementary school</td>
      <td>NaN</td>
      <td>All or almost all the time (I'm full-time remote)</td>
      <td>NaN</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A doctoral degree</td>
      <td>White or of European descent</td>
      <td>Disagree</td>
      <td>Somewhat agree</td>
      <td>Strongly disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>16</th>
      <td>17</td>
      <td>Professional developer</td>
      <td>Yes, both</td>
      <td>United Kingdom</td>
      <td>No</td>
      <td>Not employed, and not looking for work</td>
      <td>Secondary school</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>...</td>
      <td>Strongly disagree</td>
      <td>Male</td>
      <td>High school</td>
      <td>White or of European descent</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>Strongly disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>17</th>
      <td>18</td>
      <td>Professional developer</td>
      <td>Yes, both</td>
      <td>United States</td>
      <td>Yes, part-time</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer science or software engineering</td>
      <td>All or almost all the time (I'm full-time remote)</td>
      <td>1,000 to 4,999 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A master's degree</td>
      <td>Native American, Pacific Islander, or Indigeno...</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>130000.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>18</th>
      <td>19</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>United States</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer science or software engineering</td>
      <td>A few days each month</td>
      <td>10,000 or more employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>82500.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>19</th>
      <td>20</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>Greece</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Doctoral degree</td>
      <td>A natural science</td>
      <td>Less than half the time, but at least one day ...</td>
      <td>Fewer than 10 employees</td>
      <td>...</td>
      <td>Strongly disagree</td>
      <td>Male</td>
      <td>A master's degree</td>
      <td>I prefer not to say</td>
      <td>Agree</td>
      <td>Somewhat agree</td>
      <td>Disagree</td>
      <td>Somewhat agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>20</th>
      <td>21</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>Brazil</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer science or software engineering</td>
      <td>Less than half the time, but at least one day ...</td>
      <td>10,000 or more employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>21</th>
      <td>22</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>United Kingdom</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>A natural science</td>
      <td>A few days each month</td>
      <td>20 to 99 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A bachelor's degree</td>
      <td>White or of European descent</td>
      <td>Somewhat agree</td>
      <td>Somewhat agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>22</th>
      <td>23</td>
      <td>Professional developer</td>
      <td>No</td>
      <td>Israel</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer engineering or electrical/electronics...</td>
      <td>A few days each month</td>
      <td>500 to 999 employees</td>
      <td>...</td>
      <td>Somewhat agree</td>
      <td>Male</td>
      <td>A bachelor's degree</td>
      <td>White or of European descent</td>
      <td>Strongly agree</td>
      <td>Somewhat agree</td>
      <td>Somewhat agree</td>
      <td>Agree</td>
      <td>100764.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>23</th>
      <td>24</td>
      <td>Professional developer</td>
      <td>Yes, both</td>
      <td>Italy</td>
      <td>No</td>
      <td>Independent contractor, freelancer, or self-em...</td>
      <td>Secondary school</td>
      <td>NaN</td>
      <td>All or almost all the time (I'm full-time remote)</td>
      <td>NaN</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>High school</td>
      <td>White or of European descent</td>
      <td>Agree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>24</th>
      <td>25</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>Belgium</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Master's degree</td>
      <td>Computer science or software engineering</td>
      <td>Never</td>
      <td>20 to 99 employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>25</th>
      <td>26</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>United States</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Master's degree</td>
      <td>Computer science or software engineering</td>
      <td>Less than half the time, but at least one day ...</td>
      <td>10,000 or more employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A master's degree</td>
      <td>White or of European descent</td>
      <td>Disagree</td>
      <td>Strongly agree</td>
      <td>Disagree</td>
      <td>Strongly agree</td>
      <td>175000.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>26</th>
      <td>27</td>
      <td>Professional developer</td>
      <td>No</td>
      <td>India</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer science or software engineering</td>
      <td>Never</td>
      <td>5,000 to 9,999 employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>27</th>
      <td>28</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>United States</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>A business discipline</td>
      <td>A few days each month</td>
      <td>100 to 499 employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>28</th>
      <td>29</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>Yes, both</td>
      <td>Israel</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Some college/university study without earning ...</td>
      <td>Computer engineering or electrical/electronics...</td>
      <td>A few days each month</td>
      <td>10 to 19 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A bachelor's degree</td>
      <td>White or of European descent</td>
      <td>Somewhat agree</td>
      <td>Somewhat agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>29</th>
      <td>30</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>Yes, I program as a hobby</td>
      <td>United States</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>A business discipline</td>
      <td>Less than half the time, but at least one day ...</td>
      <td>10,000 or more employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>...</th>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr>
      <th>51362</th>
      <td>51363</td>
      <td>Professional developer</td>
      <td>No</td>
      <td>United States</td>
      <td>No</td>
      <td>Independent contractor, freelancer, or self-em...</td>
      <td>Master's degree</td>
      <td>Management information systems</td>
      <td>All or almost all the time (I'm full-time remote)</td>
      <td>NaN</td>
      <td>...</td>
      <td>Strongly disagree</td>
      <td>Male</td>
      <td>A master's degree</td>
      <td>White or of European descent</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51363</th>
      <td>51364</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>Estonia</td>
      <td>I prefer not to say</td>
      <td>Independent contractor, freelancer, or self-em...</td>
      <td>Bachelor's degree</td>
      <td>Information technology, networking, or system ...</td>
      <td>Less than half the time, but at least one day ...</td>
      <td>NaN</td>
      <td>...</td>
      <td>NaN</td>
      <td>Male</td>
      <td>A master's degree</td>
      <td>White or of European descent</td>
      <td>Strongly agree</td>
      <td>Somewhat agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51364</th>
      <td>51365</td>
      <td>Professional developer</td>
      <td>Yes, I contribute to open source projects</td>
      <td>Germany</td>
      <td>No</td>
      <td>Independent contractor, freelancer, or self-em...</td>
      <td>Secondary school</td>
      <td>NaN</td>
      <td>Less than half the time, but at least one day ...</td>
      <td>NaN</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>High school</td>
      <td>White or of European descent</td>
      <td>Somewhat agree</td>
      <td>Agree</td>
      <td>Strongly disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51365</th>
      <td>51366</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>Czech Republic</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Some college/university study without earning ...</td>
      <td>A natural science</td>
      <td>About half the time</td>
      <td>10,000 or more employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>Male</td>
      <td>A master's degree</td>
      <td>White or of European descent</td>
      <td>Strongly agree</td>
      <td>Somewhat agree</td>
      <td>Disagree</td>
      <td>Disagree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51366</th>
      <td>51367</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>Sweden</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Master's degree</td>
      <td>Computer science or software engineering</td>
      <td>It's complicated</td>
      <td>1,000 to 4,999 employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51367</th>
      <td>51368</td>
      <td>Student</td>
      <td>Yes, both</td>
      <td>Spain</td>
      <td>Yes, full-time</td>
      <td>Employed part-time</td>
      <td>Bachelor's degree</td>
      <td>Computer engineering or electrical/electronics...</td>
      <td>About half the time</td>
      <td>I don't know</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Female</td>
      <td>A bachelor's degree</td>
      <td>Hispanic or Latino/Latina; White or of Europea...</td>
      <td>Somewhat agree</td>
      <td>Somewhat agree</td>
      <td>Strongly disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51368</th>
      <td>51369</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>Taiwan</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Master's degree</td>
      <td>A social science</td>
      <td>Never</td>
      <td>5,000 to 9,999 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A master's degree</td>
      <td>White or of European descent</td>
      <td>Disagree</td>
      <td>Strongly agree</td>
      <td>Strongly disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51369</th>
      <td>51370</td>
      <td>Student</td>
      <td>Yes, I program as a hobby</td>
      <td>Poland</td>
      <td>Yes, full-time</td>
      <td>Employed part-time</td>
      <td>Some college/university study without earning ...</td>
      <td>Computer science or software engineering</td>
      <td>About half the time</td>
      <td>Fewer than 10 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A master's degree</td>
      <td>White or of European descent</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>14814.814815</td>
    </tr>
    <tr>
      <th>51370</th>
      <td>51371</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>United Kingdom</td>
      <td>No</td>
      <td>Independent contractor, freelancer, or self-em...</td>
      <td>Some college/university study without earning ...</td>
      <td>I never declared a major</td>
      <td>All or almost all the time (I'm full-time remote)</td>
      <td>NaN</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>Some college/university study, no bachelor's d...</td>
      <td>White or of European descent</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>Strongly disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51371</th>
      <td>51372</td>
      <td>Professional developer</td>
      <td>No</td>
      <td>Netherlands</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer science or software engineering</td>
      <td>All or almost all the time (I'm full-time remote)</td>
      <td>Fewer than 10 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A bachelor's degree</td>
      <td>White or of European descent</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>Strongly disagree</td>
      <td>Agree</td>
      <td>74193.548387</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51372</th>
      <td>51373</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>United Kingdom</td>
      <td>Yes, full-time</td>
      <td>Employed full-time</td>
      <td>Secondary school</td>
      <td>NaN</td>
      <td>Never</td>
      <td>Fewer than 10 employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51373</th>
      <td>51374</td>
      <td>Professional developer</td>
      <td>Yes, both</td>
      <td>United States</td>
      <td>No</td>
      <td>Independent contractor, freelancer, or self-em...</td>
      <td>Some college/university study without earning ...</td>
      <td>Computer science or software engineering</td>
      <td>All or almost all the time (I'm full-time remote)</td>
      <td>NaN</td>
      <td>...</td>
      <td>Strongly disagree</td>
      <td>Male</td>
      <td>Some college/university study, no bachelor's d...</td>
      <td>NaN</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Somewhat agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51374</th>
      <td>51375</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>Sweden</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer science or software engineering</td>
      <td>A few days each month</td>
      <td>100 to 499 employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51375</th>
      <td>51376</td>
      <td>Professional developer</td>
      <td>No</td>
      <td>United Kingdom</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer programming or Web development</td>
      <td>A few days each month</td>
      <td>1,000 to 4,999 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A bachelor's degree</td>
      <td>White or of European descent</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>Strongly disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51376</th>
      <td>51377</td>
      <td>Student</td>
      <td>Yes, I program as a hobby</td>
      <td>Germany</td>
      <td>Yes, full-time</td>
      <td>Independent contractor, freelancer, or self-em...</td>
      <td>Secondary school</td>
      <td>NaN</td>
      <td>Never</td>
      <td>NaN</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A bachelor's degree</td>
      <td>White or of European descent</td>
      <td>Somewhat agree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>43010.752688</td>
    </tr>
    <tr>
      <th>51377</th>
      <td>51378</td>
      <td>Professional developer</td>
      <td>No</td>
      <td>United Kingdom</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer science or software engineering</td>
      <td>A few days each month</td>
      <td>1,000 to 4,999 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>Primary/elementary school</td>
      <td>NaN</td>
      <td>Strongly agree</td>
      <td>Somewhat agree</td>
      <td>Disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51378</th>
      <td>51379</td>
      <td>Professional developer</td>
      <td>Yes, I contribute to open source projects</td>
      <td>Cyprus</td>
      <td>No</td>
      <td>Employed part-time</td>
      <td>Secondary school</td>
      <td>NaN</td>
      <td>All or almost all the time (I'm full-time remote)</td>
      <td>Fewer than 10 employees</td>
      <td>...</td>
      <td>Strongly disagree</td>
      <td>Male</td>
      <td>A doctoral degree</td>
      <td>NaN</td>
      <td>Somewhat agree</td>
      <td>Strongly agree</td>
      <td>Strongly disagree</td>
      <td>Strongly agree</td>
      <td>107526.881720</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51379</th>
      <td>51380</td>
      <td>Student</td>
      <td>Yes, I program as a hobby</td>
      <td>Belgium</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Master's degree</td>
      <td>A non-computer-focused engineering discipline</td>
      <td>Never</td>
      <td>10,000 or more employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>26881.720430</td>
    </tr>
    <tr>
      <th>51380</th>
      <td>51381</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>United States</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Some college/university study without earning ...</td>
      <td>Computer programming or Web development</td>
      <td>More than half, but not all, the time</td>
      <td>10,000 or more employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>Male</td>
      <td>High school</td>
      <td>White or of European descent</td>
      <td>Agree</td>
      <td>Somewhat agree</td>
      <td>Disagree</td>
      <td>Somewhat agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51381</th>
      <td>51382</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>Yes, both</td>
      <td>United States</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Doctoral degree</td>
      <td>Psychology</td>
      <td>More than half, but not all, the time</td>
      <td>10,000 or more employees</td>
      <td>...</td>
      <td>Strongly disagree</td>
      <td>Male</td>
      <td>A bachelor's degree</td>
      <td>White or of European descent</td>
      <td>Somewhat agree</td>
      <td>Strongly agree</td>
      <td>Strongly disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51382</th>
      <td>51383</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>France</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Master's degree</td>
      <td>Computer science or software engineering</td>
      <td>Never</td>
      <td>100 to 499 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A master's degree</td>
      <td>White or of European descent</td>
      <td>Agree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Somewhat agree</td>
      <td>32258.064516</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51383</th>
      <td>51384</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>Sweden</td>
      <td>No</td>
      <td>Independent contractor, freelancer, or self-em...</td>
      <td>I never completed any formal education</td>
      <td>NaN</td>
      <td>All or almost all the time (I'm full-time remote)</td>
      <td>NaN</td>
      <td>...</td>
      <td>Strongly disagree</td>
      <td>Male</td>
      <td>Some college/university study, no bachelor's d...</td>
      <td>White or of European descent</td>
      <td>Agree</td>
      <td>Somewhat agree</td>
      <td>Strongly disagree</td>
      <td>Disagree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51384</th>
      <td>51385</td>
      <td>Professional developer</td>
      <td>No</td>
      <td>United States</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer programming or Web development</td>
      <td>Never</td>
      <td>20 to 99 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A master's degree</td>
      <td>White or of European descent</td>
      <td>Somewhat agree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Somewhat agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51385</th>
      <td>51386</td>
      <td>Used to be a professional developer</td>
      <td>Yes, both</td>
      <td>United Kingdom</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Master's degree</td>
      <td>A business discipline</td>
      <td>A few days each month</td>
      <td>1,000 to 4,999 employees</td>
      <td>...</td>
      <td>Somewhat agree</td>
      <td>Female</td>
      <td>High school</td>
      <td>White or of European descent</td>
      <td>Somewhat agree</td>
      <td>Strongly agree</td>
      <td>Disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51386</th>
      <td>51387</td>
      <td>Professional developer</td>
      <td>Yes, both</td>
      <td>Romania</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Some college/university study without earning ...</td>
      <td>Something else</td>
      <td>It's complicated</td>
      <td>100 to 499 employees</td>
      <td>...</td>
      <td>Somewhat agree</td>
      <td>Male</td>
      <td>High school</td>
      <td>White or of European descent</td>
      <td>Agree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Somewhat agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51387</th>
      <td>51388</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>United States</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>A social science</td>
      <td>A few days each month</td>
      <td>100 to 499 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A doctoral degree</td>
      <td>East Asian; White or of European descent</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>Strongly disagree</td>
      <td>Strongly agree</td>
      <td>58000.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51388</th>
      <td>51389</td>
      <td>Student</td>
      <td>No</td>
      <td>Venezuela</td>
      <td>Yes, full-time</td>
      <td>Employed full-time</td>
      <td>Master's degree</td>
      <td>Computer programming or Web development</td>
      <td>Never</td>
      <td>100 to 499 employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>Male</td>
      <td>A master's degree</td>
      <td>Black or of African descent; Hispanic or Latin...</td>
      <td>Somewhat agree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51389</th>
      <td>51390</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>Canada</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Some college/university study without earning ...</td>
      <td>Information technology, networking, or system ...</td>
      <td>Less than half the time, but at least one day ...</td>
      <td>10 to 19 employees</td>
      <td>...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51390</th>
      <td>51391</td>
      <td>Professional developer</td>
      <td>Yes, I program as a hobby</td>
      <td>United States</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer science or software engineering</td>
      <td>Never</td>
      <td>Fewer than 10 employees</td>
      <td>...</td>
      <td>Disagree</td>
      <td>Male</td>
      <td>A bachelor's degree</td>
      <td>White or of European descent</td>
      <td>Disagree</td>
      <td>Agree</td>
      <td>Disagree</td>
      <td>Strongly agree</td>
      <td>40000.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51391</th>
      <td>51392</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>No</td>
      <td>Ireland</td>
      <td>No</td>
      <td>Employed full-time</td>
      <td>Bachelor's degree</td>
      <td>Computer science or software engineering</td>
      <td>It's complicated</td>
      <td>10,000 or more employees</td>
      <td>...</td>
      <td>Somewhat agree</td>
      <td>Male</td>
      <td>A bachelor's degree</td>
      <td>White or of European descent</td>
      <td>Somewhat agree</td>
      <td>Strongly agree</td>
      <td>Disagree</td>
      <td>Strongly agree</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
  </tbody>
</table>
<p>51392 rows × 154 columns</p>
</div>




```python
df_dev_profile = df[['respondent', 'professional', 'gender', 'race', 'country', 'currency',
                     'university', 'majorundergrad', 'salary', 'expectedsalary']]
```


```python
df_dev_profile
```




<div>
<style scoped>
    .dataframe tbody tr th:only-of-type {
        vertical-align: middle;
    }

    .dataframe tbody tr th {
        vertical-align: top;
    }

    .dataframe thead th {
        text-align: right;
    }
</style>
<table border="1" class="dataframe">
  <thead>
    <tr style="text-align: right;">
      <th></th>
      <th>respondent</th>
      <th>professional</th>
      <th>gender</th>
      <th>race</th>
      <th>country</th>
      <th>currency</th>
      <th>university</th>
      <th>majorundergrad</th>
      <th>salary</th>
      <th>expectedsalary</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>0</th>
      <td>1</td>
      <td>Student</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United States</td>
      <td>NaN</td>
      <td>No</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>1</th>
      <td>2</td>
      <td>Student</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United Kingdom</td>
      <td>British pounds sterling (£)</td>
      <td>Yes, full-time</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>37500.000000</td>
    </tr>
    <tr>
      <th>2</th>
      <td>3</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United Kingdom</td>
      <td>British pounds sterling (£)</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>113750.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>3</th>
      <td>4</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United States</td>
      <td>NaN</td>
      <td>No</td>
      <td>A non-computer-focused engineering discipline</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>4</th>
      <td>5</td>
      <td>Professional developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Switzerland</td>
      <td>NaN</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>5</th>
      <td>6</td>
      <td>Student</td>
      <td>NaN</td>
      <td>White or of European descent</td>
      <td>New Zealand</td>
      <td>NaN</td>
      <td>Yes, full-time</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>6</th>
      <td>7</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United States</td>
      <td>NaN</td>
      <td>No</td>
      <td>A non-computer-focused engineering discipline</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>7</th>
      <td>8</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Poland</td>
      <td>NaN</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>8</th>
      <td>9</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>Hispanic or Latino/Latina</td>
      <td>Colombia</td>
      <td>NaN</td>
      <td>Yes, part-time</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>9</th>
      <td>10</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>France</td>
      <td>NaN</td>
      <td>Yes, full-time</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>10</th>
      <td>11</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>Female</td>
      <td>White or of European descent</td>
      <td>United States</td>
      <td>NaN</td>
      <td>No</td>
      <td>A social science</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>11</th>
      <td>12</td>
      <td>Professional developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Canada</td>
      <td>Canadian dollars (C$)</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>12</th>
      <td>13</td>
      <td>Used to be a professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United Kingdom</td>
      <td>NaN</td>
      <td>No</td>
      <td>Mathematics or statistics</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>13</th>
      <td>14</td>
      <td>Professional developer</td>
      <td>Female</td>
      <td>Hispanic or Latino/Latina</td>
      <td>Germany</td>
      <td>NaN</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>14</th>
      <td>15</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United Kingdom</td>
      <td>British pounds sterling (£)</td>
      <td>No</td>
      <td>Computer engineering or electrical/electronics...</td>
      <td>100000.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>15</th>
      <td>16</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United States</td>
      <td>NaN</td>
      <td>Yes, part-time</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>16</th>
      <td>17</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United Kingdom</td>
      <td>NaN</td>
      <td>No</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>17</th>
      <td>18</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>Native American, Pacific Islander, or Indigeno...</td>
      <td>United States</td>
      <td>U.S. dollars ($)</td>
      <td>Yes, part-time</td>
      <td>Computer science or software engineering</td>
      <td>130000.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>18</th>
      <td>19</td>
      <td>Professional developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>United States</td>
      <td>U.S. dollars ($)</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>82500.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>19</th>
      <td>20</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>I prefer not to say</td>
      <td>Greece</td>
      <td>Euros (€)</td>
      <td>No</td>
      <td>A natural science</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>20</th>
      <td>21</td>
      <td>Professional developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Brazil</td>
      <td>Brazilian reais (R$)</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>21</th>
      <td>22</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United Kingdom</td>
      <td>NaN</td>
      <td>No</td>
      <td>A natural science</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>22</th>
      <td>23</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Israel</td>
      <td>U.S. dollars ($)</td>
      <td>No</td>
      <td>Computer engineering or electrical/electronics...</td>
      <td>100764.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>23</th>
      <td>24</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Italy</td>
      <td>NaN</td>
      <td>No</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>24</th>
      <td>25</td>
      <td>Professional developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Belgium</td>
      <td>NaN</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>25</th>
      <td>26</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United States</td>
      <td>U.S. dollars ($)</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>175000.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>26</th>
      <td>27</td>
      <td>Professional developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>India</td>
      <td>Indian rupees (?)</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>27</th>
      <td>28</td>
      <td>Professional developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>United States</td>
      <td>NaN</td>
      <td>No</td>
      <td>A business discipline</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>28</th>
      <td>29</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Israel</td>
      <td>NaN</td>
      <td>No</td>
      <td>Computer engineering or electrical/electronics...</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>29</th>
      <td>30</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>United States</td>
      <td>NaN</td>
      <td>No</td>
      <td>A business discipline</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>...</th>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr>
      <th>51362</th>
      <td>51363</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United States</td>
      <td>NaN</td>
      <td>No</td>
      <td>Management information systems</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51363</th>
      <td>51364</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Estonia</td>
      <td>NaN</td>
      <td>I prefer not to say</td>
      <td>Information technology, networking, or system ...</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51364</th>
      <td>51365</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Germany</td>
      <td>NaN</td>
      <td>No</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51365</th>
      <td>51366</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Czech Republic</td>
      <td>NaN</td>
      <td>No</td>
      <td>A natural science</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51366</th>
      <td>51367</td>
      <td>Professional developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Sweden</td>
      <td>NaN</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51367</th>
      <td>51368</td>
      <td>Student</td>
      <td>Female</td>
      <td>Hispanic or Latino/Latina; White or of Europea...</td>
      <td>Spain</td>
      <td>NaN</td>
      <td>Yes, full-time</td>
      <td>Computer engineering or electrical/electronics...</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51368</th>
      <td>51369</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Taiwan</td>
      <td>NaN</td>
      <td>No</td>
      <td>A social science</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51369</th>
      <td>51370</td>
      <td>Student</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Poland</td>
      <td>Polish zloty (zl)</td>
      <td>Yes, full-time</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>14814.814815</td>
    </tr>
    <tr>
      <th>51370</th>
      <td>51371</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United Kingdom</td>
      <td>NaN</td>
      <td>No</td>
      <td>I never declared a major</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51371</th>
      <td>51372</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Netherlands</td>
      <td>Euros (€)</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>74193.548387</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51372</th>
      <td>51373</td>
      <td>Professional developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>United Kingdom</td>
      <td>British pounds sterling (£)</td>
      <td>Yes, full-time</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51373</th>
      <td>51374</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>NaN</td>
      <td>United States</td>
      <td>NaN</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51374</th>
      <td>51375</td>
      <td>Professional developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Sweden</td>
      <td>Swedish kroner (SEK)</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51375</th>
      <td>51376</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United Kingdom</td>
      <td>British pounds sterling (£)</td>
      <td>No</td>
      <td>Computer programming or Web development</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51376</th>
      <td>51377</td>
      <td>Student</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Germany</td>
      <td>Euros (€)</td>
      <td>Yes, full-time</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>43010.752688</td>
    </tr>
    <tr>
      <th>51377</th>
      <td>51378</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>NaN</td>
      <td>United Kingdom</td>
      <td>British pounds sterling (£)</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51378</th>
      <td>51379</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>NaN</td>
      <td>Cyprus</td>
      <td>Euros (€)</td>
      <td>No</td>
      <td>NaN</td>
      <td>107526.881720</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51379</th>
      <td>51380</td>
      <td>Student</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Belgium</td>
      <td>Euros (€)</td>
      <td>No</td>
      <td>A non-computer-focused engineering discipline</td>
      <td>NaN</td>
      <td>26881.720430</td>
    </tr>
    <tr>
      <th>51380</th>
      <td>51381</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United States</td>
      <td>NaN</td>
      <td>No</td>
      <td>Computer programming or Web development</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51381</th>
      <td>51382</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United States</td>
      <td>NaN</td>
      <td>No</td>
      <td>Psychology</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51382</th>
      <td>51383</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>France</td>
      <td>Euros (€)</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>32258.064516</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51383</th>
      <td>51384</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Sweden</td>
      <td>NaN</td>
      <td>No</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51384</th>
      <td>51385</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United States</td>
      <td>NaN</td>
      <td>No</td>
      <td>Computer programming or Web development</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51385</th>
      <td>51386</td>
      <td>Used to be a professional developer</td>
      <td>Female</td>
      <td>White or of European descent</td>
      <td>United Kingdom</td>
      <td>NaN</td>
      <td>No</td>
      <td>A business discipline</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51386</th>
      <td>51387</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Romania</td>
      <td>NaN</td>
      <td>No</td>
      <td>Something else</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51387</th>
      <td>51388</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>East Asian; White or of European descent</td>
      <td>United States</td>
      <td>U.S. dollars ($)</td>
      <td>No</td>
      <td>A social science</td>
      <td>58000.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51388</th>
      <td>51389</td>
      <td>Student</td>
      <td>Male</td>
      <td>Black or of African descent; Hispanic or Latin...</td>
      <td>Venezuela</td>
      <td>NaN</td>
      <td>Yes, full-time</td>
      <td>Computer programming or Web development</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51389</th>
      <td>51390</td>
      <td>Professional developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Canada</td>
      <td>NaN</td>
      <td>No</td>
      <td>Information technology, networking, or system ...</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51390</th>
      <td>51391</td>
      <td>Professional developer</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>United States</td>
      <td>U.S. dollars ($)</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>40000.000000</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51391</th>
      <td>51392</td>
      <td>Professional non-developer who sometimes write...</td>
      <td>Male</td>
      <td>White or of European descent</td>
      <td>Ireland</td>
      <td>NaN</td>
      <td>No</td>
      <td>Computer science or software engineering</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
  </tbody>
</table>
<p>51392 rows × 10 columns</p>
</div>




```python
df_dev_skill = df[['respondent', 'haveworkedlanguage', 'haveworkeddatabase', 'haveworkedframework', 'haveworkedplatform', 
                  'wantworklanguage', 'wantworkdatabase', 'wantworkframework', 'wantworkplatform', 'ide', 'versioncontrol',
                    'yearscodedjob']]
```


```python
df_dev_skill.head()
```




<div>
<style scoped>
    .dataframe tbody tr th:only-of-type {
        vertical-align: middle;
    }

    .dataframe tbody tr th {
        vertical-align: top;
    }

    .dataframe thead th {
        text-align: right;
    }
</style>
<table border="1" class="dataframe">
  <thead>
    <tr style="text-align: right;">
      <th></th>
      <th>respondent</th>
      <th>haveworkedlanguage</th>
      <th>haveworkeddatabase</th>
      <th>haveworkedframework</th>
      <th>haveworkedplatform</th>
      <th>wantworklanguage</th>
      <th>wantworkdatabase</th>
      <th>wantworkframework</th>
      <th>wantworkplatform</th>
      <th>ide</th>
      <th>versioncontrol</th>
      <th>yearscodedjob</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>0</th>
      <td>1</td>
      <td>Swift</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>iOS</td>
      <td>Swift</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>iOS</td>
      <td>Atom; Xcode</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>1</th>
      <td>2</td>
      <td>JavaScript; Python; Ruby; SQL</td>
      <td>MySQL; SQLite</td>
      <td>.NET Core</td>
      <td>Amazon Web Services (AWS)</td>
      <td>Java; Python; Ruby; SQL</td>
      <td>MySQL; SQLite</td>
      <td>.NET Core</td>
      <td>Linux Desktop; Raspberry Pi; Amazon Web Servic...</td>
      <td>Atom; Notepad++; Vim; PyCharm; RubyMine; Visua...</td>
      <td>Git</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>2</th>
      <td>3</td>
      <td>Java; PHP; Python</td>
      <td>MySQL</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>C; Python; Rust</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Sublime Text; Vim; IntelliJ</td>
      <td>Mercurial</td>
      <td>20 or more years</td>
    </tr>
    <tr>
      <th>3</th>
      <td>4</td>
      <td>Matlab; Python; R; SQL</td>
      <td>MongoDB; Redis; SQL Server; MySQL; SQLite</td>
      <td>React</td>
      <td>Windows Desktop; Linux Desktop; Mac OS; Amazon...</td>
      <td>Matlab; Python; R; SQL</td>
      <td>MongoDB; Redis; SQL Server; MySQL; SQLite</td>
      <td>Hadoop; Node.js; React</td>
      <td>Windows Desktop; Linux Desktop; Mac OS; Amazon...</td>
      <td>Notepad++; Sublime Text; TextMate; Vim; IPytho...</td>
      <td>Git</td>
      <td>9 to 10 years</td>
    </tr>
    <tr>
      <th>4</th>
      <td>5</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>10 to 11 years</td>
    </tr>
  </tbody>
</table>
</div>




```python
df_dev_category = df[['respondent', 'developertype', 'webdevelopertype', 'mobiledevelopertype', 'nondevelopertype']]
```


```python
df_dev_category
```




<div>
<style scoped>
    .dataframe tbody tr th:only-of-type {
        vertical-align: middle;
    }

    .dataframe tbody tr th {
        vertical-align: top;
    }

    .dataframe thead th {
        text-align: right;
    }
</style>
<table border="1" class="dataframe">
  <thead>
    <tr style="text-align: right;">
      <th></th>
      <th>respondent</th>
      <th>developertype</th>
      <th>webdevelopertype</th>
      <th>mobiledevelopertype</th>
      <th>nondevelopertype</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>0</th>
      <td>1</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>1</th>
      <td>2</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>2</th>
      <td>3</td>
      <td>Other</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>3</th>
      <td>4</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Data scientist</td>
    </tr>
    <tr>
      <th>4</th>
      <td>5</td>
      <td>Mobile developer; Graphics programming; Deskto...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>5</th>
      <td>6</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>6</th>
      <td>7</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Data scientist</td>
    </tr>
    <tr>
      <th>7</th>
      <td>8</td>
      <td>Web developer</td>
      <td>Full stack Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>8</th>
      <td>9</td>
      <td>Web developer; Mobile developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>9</th>
      <td>10</td>
      <td>Mobile developer; Desktop applications developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>10</th>
      <td>11</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Other</td>
    </tr>
    <tr>
      <th>11</th>
      <td>12</td>
      <td>Web developer</td>
      <td>Back-end Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>12</th>
      <td>13</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>13</th>
      <td>14</td>
      <td>Web developer</td>
      <td>Full stack Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>14</th>
      <td>15</td>
      <td>Embedded applications/devices developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>15</th>
      <td>16</td>
      <td>Desktop applications developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>16</th>
      <td>17</td>
      <td>Web developer</td>
      <td>Full stack Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>17</th>
      <td>18</td>
      <td>Web developer; Embedded applications/devices d...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>18</th>
      <td>19</td>
      <td>Web developer</td>
      <td>Full stack Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>19</th>
      <td>20</td>
      <td>Data scientist; Other</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>20</th>
      <td>21</td>
      <td>Web developer</td>
      <td>Full stack Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>21</th>
      <td>22</td>
      <td>Web developer; Mobile developer; Desktop appli...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>22</th>
      <td>23</td>
      <td>Other</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>23</th>
      <td>24</td>
      <td>Web developer</td>
      <td>Full stack Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>24</th>
      <td>25</td>
      <td>Web developer; Other</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>25</th>
      <td>26</td>
      <td>Web developer</td>
      <td>Back-end Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>26</th>
      <td>27</td>
      <td>Web developer; Mobile developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>27</th>
      <td>28</td>
      <td>Web developer; Desktop applications developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>28</th>
      <td>29</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>C-suite executive; Product manager</td>
    </tr>
    <tr>
      <th>29</th>
      <td>30</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Other</td>
    </tr>
    <tr>
      <th>...</th>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr>
      <th>51362</th>
      <td>51363</td>
      <td>Web developer</td>
      <td>Full stack Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51363</th>
      <td>51364</td>
      <td>Web developer; Database administrator</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51364</th>
      <td>51365</td>
      <td>Web developer; Mobile developer; Desktop appli...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51365</th>
      <td>51366</td>
      <td>Other</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51366</th>
      <td>51367</td>
      <td>Web developer; Desktop applications developer;...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51367</th>
      <td>51368</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51368</th>
      <td>51369</td>
      <td>Mobile developer</td>
      <td>NaN</td>
      <td>iOS</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51369</th>
      <td>51370</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51370</th>
      <td>51371</td>
      <td>Web developer</td>
      <td>Full stack Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51371</th>
      <td>51372</td>
      <td>Web developer; Machine learning specialist; De...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51372</th>
      <td>51373</td>
      <td>Web developer</td>
      <td>Full stack Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51373</th>
      <td>51374</td>
      <td>Graphics programming</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51374</th>
      <td>51375</td>
      <td>Web developer</td>
      <td>Back-end Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51375</th>
      <td>51376</td>
      <td>Web developer; Mobile developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51376</th>
      <td>51377</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51377</th>
      <td>51378</td>
      <td>Web developer</td>
      <td>Back-end Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51378</th>
      <td>51379</td>
      <td>Mobile developer; DevOps specialist</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51379</th>
      <td>51380</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51380</th>
      <td>51381</td>
      <td>Other</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51381</th>
      <td>51382</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Data scientist</td>
    </tr>
    <tr>
      <th>51382</th>
      <td>51383</td>
      <td>Web developer</td>
      <td>Front-end Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51383</th>
      <td>51384</td>
      <td>Web developer; Mobile developer; Desktop appli...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51384</th>
      <td>51385</td>
      <td>Web developer</td>
      <td>Front-end Web developer</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51385</th>
      <td>51386</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51386</th>
      <td>51387</td>
      <td>Web developer; Mobile developer; Developer wit...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51387</th>
      <td>51388</td>
      <td>Web developer; Developer with a statistics or ...</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51388</th>
      <td>51389</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51389</th>
      <td>51390</td>
      <td>Web developer; Systems administrator</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51390</th>
      <td>51391</td>
      <td>Web developer; Mobile developer</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
    <tr>
      <th>51391</th>
      <td>51392</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Other</td>
    </tr>
  </tbody>
</table>
<p>51392 rows × 5 columns</p>
</div>




```python
df_dev_life = df[['respondent', 'jobsatisfaction', 'careersatisfaction', 'importantbenefits', 'auditoryenvironment']]
```


```python
df_dev_life.head()
```




<div>
<style scoped>
    .dataframe tbody tr th:only-of-type {
        vertical-align: middle;
    }

    .dataframe tbody tr th {
        vertical-align: top;
    }

    .dataframe thead th {
        text-align: right;
    }
</style>
<table border="1" class="dataframe">
  <thead>
    <tr style="text-align: right;">
      <th></th>
      <th>respondent</th>
      <th>jobsatisfaction</th>
      <th>careersatisfaction</th>
      <th>importantbenefits</th>
      <th>auditoryenvironment</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th>0</th>
      <td>1</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Stock options; Vacation/days off; Remote options</td>
      <td>Turn on some music</td>
    </tr>
    <tr>
      <th>1</th>
      <td>2</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>NaN</td>
      <td>Put on some ambient sounds (e.g. whale songs, ...</td>
    </tr>
    <tr>
      <th>2</th>
      <td>3</td>
      <td>9.0</td>
      <td>8.0</td>
      <td>NaN</td>
      <td>Turn on some music</td>
    </tr>
    <tr>
      <th>3</th>
      <td>4</td>
      <td>3.0</td>
      <td>6.0</td>
      <td>Stock options; Annual bonus; Health benefits; ...</td>
      <td>Turn on some music</td>
    </tr>
    <tr>
      <th>4</th>
      <td>5</td>
      <td>8.0</td>
      <td>6.0</td>
      <td>NaN</td>
      <td>NaN</td>
    </tr>
  </tbody>
</table>
</div>




```python
import psycopg2
from sqlalchemy import create_engine
```


```python
conn = psycopg2.connect("dbname='stack_overflow_survey' user='DarkWizard' host='localhost'")
cur = conn.cursor()
engine = create_engine(r'postgresql://DarkWizard@localhost/stack_overflow_survey')
```


```python
print("Building the dev_profiles table")
df_dev_profile.to_sql('dev_profiles', engine)
print("Have built the dev_profiles table")
```

    Building the dev_profiles table
    Have built the dev_profiles table



```python
print("Building the dev_skill table")
df_dev_skill.to_sql('dev_skill', engine, index=False)
print("Have built the dev_skill table")
```

    Building the dev_skill table
    Have built the dev_skill table



```python
print("Building the dev_category table")
df_dev_category.to_sql('dev_category', engine, index=False)
print("Have built the dev_category table")

```

    Building the dev_category table
    Have built the dev_category table



```python
print("Building the dev_life table")
df_dev_life.to_sql('dev_life', engine, index=False)
print("Have built the dev_life table")
```

    Building the dev_life table



    --

    ValueErrorTraceback (most recent call last)

    <ipython-input-106-46183526af71> in <module>()
          1 print("Building the dev_life table")
    ----> 2 df_dev_life.to_sql('dev_life', engine, index=False)
          3 print("Have built the dev_life table")


    /usr/local/lib/python3.6/site-packages/pandas/core/generic.py in to_sql(self, name, con, flavor, schema, if_exists, index, index_label, chunksize, dtype)
       1532         sql.to_sql(self, name, con, flavor=flavor, schema=schema,
       1533                    if_exists=if_exists, index=index, index_label=index_label,
    -> 1534                    chunksize=chunksize, dtype=dtype)
       1535 
       1536     def to_pickle(self, path, compression='infer',


    /usr/local/lib/python3.6/site-packages/pandas/io/sql.py in to_sql(frame, name, con, flavor, schema, if_exists, index, index_label, chunksize, dtype)
        471     pandas_sql.to_sql(frame, name, if_exists=if_exists, index=index,
        472                       index_label=index_label, schema=schema,
    --> 473                       chunksize=chunksize, dtype=dtype)
        474 
        475 


    /usr/local/lib/python3.6/site-packages/pandas/io/sql.py in to_sql(self, frame, name, if_exists, index, index_label, schema, chunksize, dtype)
       1153                          if_exists=if_exists, index_label=index_label,
       1154                          schema=schema, dtype=dtype)
    -> 1155         table.create()
       1156         table.insert(chunksize)
       1157         if (not name.isdigit() and not name.islower()):


    /usr/local/lib/python3.6/site-packages/pandas/io/sql.py in create(self)
        590         if self.exists():
        591             if self.if_exists == 'fail':
    --> 592                 raise ValueError("Table '%s' already exists." % self.name)
        593             elif self.if_exists == 'replace':
        594                 self.pd_sql.drop_table(self.name, self.schema)


    ValueError: Table 'dev_life' already exists.


51392 people took the survey


```python
gender_counts = df['gender'].value_counts()
```


```python
gender_counts[:10].plot(kind='bar')
```




    <matplotlib.axes._subplots.AxesSubplot at 0x11bbc3f28>




![png](output_19_1.png)



```python
race_counts = df['race'].value_counts()
race_counts[:10].plot(kind='bar')
```




    <matplotlib.axes._subplots.AxesSubplot at 0x11bb33160>




![png](output_20_1.png)



```python
country_counts = df['country'].value_counts()
country_counts[:10].plot(kind='bar')
```




    <matplotlib.axes._subplots.AxesSubplot at 0x11db47320>




![png](output_21_1.png)



```python
profession_counts = df['professional'].value_counts()
profession_counts[:10].plot(kind='bar')
```




    <matplotlib.axes._subplots.AxesSubplot at 0x11db28b00>




![png](output_22_1.png)



```python
majorundergrad_counts = df['majorundergrad'].value_counts()
majorundergrad_counts[:10].plot(kind='bar')
```




    <matplotlib.axes._subplots.AxesSubplot at 0x11da98c18>




![png](output_23_1.png)



```python
wantworklanguage_counts = df['wantworklanguage'].value_counts()
wantworklanguage_counts[:10].plot(kind='bar')
```




    <matplotlib.axes._subplots.AxesSubplot at 0x11e7c6358>




![png](output_24_1.png)



```python
wantworkplatform_counts = df['wantworkplatform'].value_counts()
wantworkplatform_counts[:20].plot(kind='bar')
```




    <matplotlib.axes._subplots.AxesSubplot at 0x11e731a20>




![png](output_25_1.png)



```python
wantworkdatabase_counts = df['wantworkdatabase'].value_counts()
wantworkdatabase_counts[:20].plot(kind='bar')
```




    <matplotlib.axes._subplots.AxesSubplot at 0x12266e940>




![png](output_26_1.png)



```python
yearscodedjob_counts = df['yearscodedjob'].value_counts()
yearscodedjob_counts[:20].plot(kind='bar')
```




    <matplotlib.axes._subplots.AxesSubplot at 0x1227de0f0>




![png](output_27_1.png)



```python
importantbenefits_counts = df['importantbenefits'].value_counts()
importantbenefits_counts[:10].plot(kind='bar')
```




    <matplotlib.axes._subplots.AxesSubplot at 0x11e7de668>




![png](output_28_1.png)



```python
query = """SELECT country, salary, developertype
            FROM(SELECT dev_profiles.respondent, country, salary, developertype FROM dev_profiles INNER JOIN dev_category ON dev_category.respondent=dev_profiles.respondent)
            AS joinedtable
            WHERE LOWER(developertype) LIKE '%database%' AND salary>1 AND country LIKE 'United States' ORDER BY salary DESC;
            """

a = cur.execute(query)
db_salary = cur.fetchall()
```


```python
lst = []
for i in b:
    lst.append(i[1])

plt.plot(lst)
plt.show()
```


![png](output_30_0.png)



```python
lst_test = [1,2,3,4]
with open("ls_test.json", "a+") as f:
    for i in lst_test:
        f.write(str(i))
        f.write('\n')
        f.close
```
