const bloodGroups = [
  {
    id: 1,
    name: "A+",
    shortDesc: "A very common and important blood type for hospitals.",
    canDonateTo: "A+, AB+",
    canReceiveFrom: "A+, A-, O+, O-",
    longDesc:
      "The A+ blood group is one of the most common globally, which makes it especially important for hospitals and blood banks. Its high availability helps ensure that patients receive safe and compatible transfusions, and it plays a key role in many medical treatments and emergency situations.",
  },
  {
    id: 2,
    name: "A-",
    shortDesc: "A rare blood type, very valuable in emergencies.",
    canDonateTo: "A-, A+, AB-, AB+",
    canReceiveFrom: "A-, O-",
    longDesc:
      "The A- blood group is less common, making it especially valuable during urgent medical needs. Its compatibility with both A and AB groups increases its importance in hospitals and blood donation centers.",
  },
  {
    id: 3,
    name: "B+",
    shortDesc: "A common blood type that hospitals request often.",
    canDonateTo: "B+, AB+",
    canReceiveFrom: "B+, B-, O+, O-",
    longDesc:
      "B+ is a fairly common blood group and is frequently needed for medical treatments and surgeries. Its compatibility with several donor types makes it a dependable option in many healthcare situations.",
  },
  {
    id: 4,
    name: "B-",
    shortDesc: "Rare type and very important for compatible transfusions.",
    canDonateTo: "B-, B+, AB-, AB+",
    canReceiveFrom: "B-, O-",
    longDesc:
      "The B- blood group is rare, which makes every donation extremely valuable. Its ability to match with both B and AB patients increases its medical significance in emergency care.",
  },
  {
    id: 5,
    name: "AB+",
    shortDesc: "Universal receiver and important for plasma donations.",
    canDonateTo: "AB+",
    canReceiveFrom: "All blood types",
    longDesc:
      "AB+ is known as the universal recipient, meaning people with this blood group can receive blood from any type. This flexibility is highly beneficial in urgent medical treatments.",
  },
  {
    id: 6,
    name: "AB-",
    shortDesc: "One of the rarest blood types, extremely important.",
    canDonateTo: "AB-, AB+",
    canReceiveFrom: "A-, B-, O-, AB-",
    longDesc:
      "AB- is among the rarest blood types, making it highly valuable for hospitals. Because of its limited availability, AB- donations play a crucial role in supporting patients who require very specific matches.",
  },
  {
    id: 7,
    name: "O+",
    shortDesc: "The most common blood type and highly needed.",
    canDonateTo: "A+, B+, AB+, O+",
    canReceiveFrom: "O+, O-",
    longDesc:
      "O+ is the most common blood group in the world, which makes it consistently needed in hospitals. Its broad compatibility with other positive blood types makes it vital during daily medical operations.",
  },
  {
    id: 8,
    name: "O-",
    shortDesc: "Universal donor — crucial for emergencies.",
    canDonateTo: "All blood types",
    canReceiveFrom: "O-",
    longDesc:
      "O- is the universal donor type, meaning its blood can be used for patients of any group in critical situations. Because of this, O- donations are essential for emergency medicine and trauma care.",
  },
];
