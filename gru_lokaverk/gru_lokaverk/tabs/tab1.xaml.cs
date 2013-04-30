using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using MySql.Data.MySqlClient;

namespace gru_lokaverk
{
    /// <summary>
    /// Interaction logic for tab1.xaml
    /// </summary>
    public partial class tab1 : UserControl
    {
        sql database = new sql();
        List<string> ClassSchedule; // weekplan
        List<string> roomClassSetup=new List<string>();//keeps the information which room is empty each time
        string[] tempSplitArray;

        int dayOfWeekID = 0, periodID=0;

        Button[] btn_grid = new Button[128];
        int counter = 0;

        private void RefreshTab1()
        {
            this.WeekPlan.Children.Clear();
            fillDataIntoGrid();
        }

        public tab1()
        {
            try
            {
                database.ConnectToDatabase();
            }
            catch (Exception e)
            {
                MessageBox.Show(e.ToString());
            }
            InitializeComponent();
            try
            {
                fillDataIntoGrid();
            }
            catch (Exception e)
            {
                MessageBox.Show(e.ToString());
            }
        }

        private void fillDataIntoGrid()
        {
            this.WeekPlan.ColumnDefinitions.Clear();
            this.WeekPlan.RowDefinitions.Clear();

            List<string> weekDays = new List<string>();
            List<string> time = new List<string>();
            string[] days = new string[8];
            try
            {
                weekDays = database.getAlldata("days","id");
                time = database.getAlldata("periods","id");
                counter = 0;
                string[] tempSplitArray = new string[2];
                foreach (string item in weekDays)//Gets the weekdays from the database and puts them into an array.
                {
                    tempSplitArray = item.Split(';');
                    days[counter] = tempSplitArray[1];
                    counter++;
                }
                counter = 0;

                for (int j = 0; j < 8; j++)//Sets Columns
                {
                    this.WeekPlan.ColumnDefinitions.Add(new ColumnDefinition());

                    periodID = 0;

                    for (int i = 0; i < 16; i++)//Sets rows
                    {
                        string content = null;
                        btn_grid[counter] = new Button();
                        btn_grid[counter].Height = 27.4;//27
                        this.WeekPlan.RowDefinitions.Add(new RowDefinition() { Height = GridLength.Auto});

                        content = "";



                        //Adds days to the week
                        if ((counter)%16==0 && counter >15)// (counter) % 15 == 0 && counter > 5
                        {
                            content = days[j-1];
                        }
                        //Adds the time to the schedule
                        if (counter>0 && counter<16)
                        {
                            string[] tempArray = new string[5];
                            char split = ';';
                            tempArray = time[counter-1].Split(split);
                            content = tempArray[1] + " - " + tempArray[2];
                        }



                        if (counter > 16 && counter < 32)//Monday
                        {
                            if (CheckRoomFree())
                            {
                                foreach (var item in roomClassSetup)
                                {
                                    if (content == "")
                                        content = item;
                                    else
                                        content = content + " / " + item;
                                }
                            }
                            else
                            {
                                content = "Allt laust!";
                            }
                        }
                        else if (counter > 32 && counter < 48)//Tuesday
                        {
                            if (CheckRoomFree())
                            {
                                foreach (var item in roomClassSetup)
                                {
                                    if (content == "")
                                        content = item;
                                    else
                                        content = content + " / " + item;
                                }
                            }
                            else
                            {
                                content = "Allt laust!";
                            }
                        }
                        else if (counter > 48 && counter < 64)//Wednsday
                        {
                            if (CheckRoomFree())
                            {
                                foreach (var item in roomClassSetup)
                                {
                                    if (content == "")
                                        content = item;
                                    else
                                        content = content + " / " + item;
                                }
                            }
                            else
                            {
                                content = "Allt laust!";
                            }
                        }
                        else if (counter > 64 && counter < 80) //Thursday
                        {
                            if (CheckRoomFree())
                            {
                                foreach (var item in roomClassSetup)
                                {
                                    if (content == "")
                                        content = item;
                                    else
                                        content = content + " / " + item;
                                }
                            }
                            else
                            {
                                content = "Allt laust!";
                            }
                        }
                        else if (counter > 80 && counter < 96) //Friday
                        {
                            if (CheckRoomFree())
                            {
                                foreach (var item in roomClassSetup)
                                {
                                    if (content == "")
                                        content = item;
                                    else
                                        content = content + " / " + item;
                                }
                            }
                            else
                            {
                                content = "Allt laust!";
                            }
                        }
                        else if (counter > 96 && counter < 112)//Saturday
                        {
                            if (CheckRoomFree())
                            {
                                foreach (var item in roomClassSetup)
                                {
                                    if (content == "")
                                        content = item;
                                    else
                                        content = content + " / " + item;
                                }
                            }
                            else
                            {
                                content = "Allt laust!";
                            }
                        }
                        else if (counter > 112 && counter < 128) //Sunday
                        {
                            if (CheckRoomFree())
                            {
                                foreach (var item in roomClassSetup)
                                {
                                    if (content == "")
                                        content = item;
                                    else
                                        content = content + " / " + item;
                                }
                            }
                            else
                            {
                                content = "Allt laust!";
                            }
                        }

                        if (periodID == 0 && dayOfWeekID == 0)
                            content = "";

                        if (content == "Allt laust!")
                            btn_grid[counter].Background = Brushes.LightBlue;
                        if (content == "")
                            btn_grid[counter].Background = Brushes.LightGray;
                        if (periodID == 0 && dayOfWeekID == 0)
                        {
                            btn_grid[counter].Background = Brushes.LightSteelBlue;
                            content = "";
                        }
                        btn_grid[counter].TabIndex = counter;
                        btn_grid[counter].Content = content;//Adds number to the fields

                        Grid.SetRow(btn_grid[counter], i);
                        Grid.SetColumn(btn_grid[counter], j);

                        this.btn_grid[counter].Click += new RoutedEventHandler(tab1_Click);
                        this.WeekPlan.Children.Add(btn_grid[counter]);

                        counter++;
                        periodID++;

                    }
                    dayOfWeekID++;
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.ToString());
            }
        }

        void tab1_Click(object sender, RoutedEventArgs e)
        {
            
        }

        private bool CheckRoomFree()
        {
            bool check = false;
            ClassSchedule = new List<string>();
            ClassSchedule = database.getAllweekPlan();
            tempSplitArray = new string[6];
            roomClassSetup.Clear();
            List<string> tempList = new List<string>();
            foreach (var item in ClassSchedule)
            {
                tempSplitArray = item.Split(';');

                if (!roomClassSetup.Contains(tempSplitArray[3]))
                    roomClassSetup.Add(tempSplitArray[3]);
                
                if (dayOfWeekID.ToString() == tempSplitArray[0] && periodID.ToString() == tempSplitArray[1])
                {
                    if (tempSplitArray[3] != null && !tempList.Contains(tempSplitArray[3]))
                    {
                        tempList.Add(tempSplitArray[3]);
                        check = true;
                    }

                }
            }
            roomClassSetup = roomClassSetup.Except(tempList).ToList();
            return check;
        }
    }
}
